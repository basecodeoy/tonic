<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Tonic\Requests;

use BaseCodeOy\Tonic\Data\RequestData;
use BaseCodeOy\Tonic\Data\RequestObjectData;
use BaseCodeOy\Tonic\Data\RequestResultData;
use BaseCodeOy\Tonic\Data\ResponseData;
use BaseCodeOy\Tonic\Exceptions\AbstractRequestException;
use BaseCodeOy\Tonic\Exceptions\ExceptionMapper;
use BaseCodeOy\Tonic\Exceptions\ForbiddenException;
use BaseCodeOy\Tonic\Exceptions\InternalErrorException;
use BaseCodeOy\Tonic\Exceptions\InvalidRequestException;
use BaseCodeOy\Tonic\Exceptions\ParseErrorException;
use BaseCodeOy\Tonic\Exceptions\UnauthorizedException;
use BaseCodeOy\Tonic\Facades\Server;
use BaseCodeOy\Tonic\Jobs\CallMethod;
use BaseCodeOy\Tonic\Rules\Identifier;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

final readonly class RequestHandler
{
    public static function createFromArray(array $request): RequestResultData
    {
        return (new self())->handle($request);
    }

    public static function createFromString(string $request): RequestResultData
    {
        return (new self())->handle($request);
    }

    public function handle(array|string $request): RequestResultData
    {
        try {
            $requestBody = $this->parse($request);

            if (\count($requestBody->requestObjects) > 10) {
                throw InvalidRequestException::create([
                    [
                        'status' => '400',
                        'source' => ['pointer' => '/'],
                        'title' => 'Invalid request',
                        'detail' => 'The request contains too many items. The maximum is 10.',
                    ],
                ]);
            }

            /** @var array<int, Collection|ResponseData> $responses */
            $responses = [];

            foreach ($requestBody->requestObjects as $requestObject) {
                try {
                    $this->validate($requestObject);

                    $requestObject = RequestObjectData::from($requestObject);

                    $method = Server::getMethodRepository()->get($requestObject->method);

                    if ($requestObject->isNotification()) {
                        CallMethod::dispatchAfterResponse($method, $requestObject);

                        // The Server MUST NOT reply to a Notification, including those that are within a batch request.
                        continue;
                    }

                    $responses[] = CallMethod::dispatchSync($method, $requestObject);
                } catch (\Throwable $exception) {
                    $responses[] = ResponseData::from([
                        'jsonrpc' => '2.0',
                        'id' => data_get($requestObject, 'id'),
                        'error' => ExceptionMapper::execute($exception)->toError(),
                    ]);
                }
            }

            if (\count($responses) < 1) {
                return RequestResultData::from([
                    'data' => $responses,
                    'statusCode' => 200,
                ]);
            }

            if ($requestBody->isBatch) {
                return RequestResultData::from([
                    'data' => $responses,
                    'statusCode' => 200,
                ]);
            }

            return RequestResultData::from([
                'data' => $responses[0],
                'statusCode' => 200,
            ]);
        } catch (\Throwable $throwable) {
            if ($throwable instanceof AbstractRequestException) {
                return RequestResultData::from([
                    'data' => ResponseData::createFromRequestException($throwable),
                    'statusCode' => 400,
                ]);
            }

            if ($throwable instanceof AuthenticationException) {
                return RequestResultData::from([
                    'data' => ResponseData::createFromRequestException(UnauthorizedException::create()),
                    'statusCode' => 401,
                ]);
            }

            if ($throwable instanceof AuthorizationException) {
                return RequestResultData::from([
                    'data' => ResponseData::createFromRequestException(ForbiddenException::create()),
                    'statusCode' => 403,
                ]);
            }

            return RequestResultData::from([
                'data' => ResponseData::createFromRequestException(
                    InternalErrorException::create($throwable),
                ),
                'statusCode' => 500,
            ]);
        }
    }

    private function parse(array|string $requestObjects): RequestData
    {
        if (\is_string($requestObjects)) {
            try {
                $requestObjects = \json_decode($requestObjects, true, 512, \JSON_THROW_ON_ERROR);
            } catch (\Throwable) {
                throw ParseErrorException::create();
            }
        }

        if (empty($requestObjects)) {
            throw InvalidRequestException::create();
        }

        if (!\is_array($requestObjects)) {
            throw InvalidRequestException::create();
        }

        if (Arr::isAssoc($requestObjects)) {
            return RequestData::from([
                'requestObjects' => [$requestObjects],
                'isBatch' => false,
            ]);
        }

        return RequestData::from([
            'requestObjects' => $requestObjects,
            'isBatch' => true,
        ]);
    }

    private function validate(mixed $data): void
    {
        if (!\is_array($data)) {
            throw InvalidRequestException::create();
        }

        $validator = Validator::make(
            $data,
            [
                'jsonrpc' => ['required', 'in:2.0'],
                'id' => new Identifier(),
                'method' => ['required', 'string'],
                'params' => ['nullable', 'array'],
            ],
        );

        if ($validator->fails()) {
            throw InvalidRequestException::createFromValidator($validator);
        }
    }
}
