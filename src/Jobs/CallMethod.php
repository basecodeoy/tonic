<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\Jobs;

use BaseCodeOy\Tonic\Contracts\MethodInterface;
use BaseCodeOy\Tonic\Contracts\UnwrappedResponseInterface;
use BaseCodeOy\Tonic\Data\RequestObjectData;
use BaseCodeOy\Tonic\Data\ResponseData;
use BaseCodeOy\Tonic\Exceptions\ExceptionMapper;
use BaseCodeOy\Tonic\Exceptions\InvalidDataException;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Spatie\LaravelData\Data;

final readonly class CallMethod
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(
        private MethodInterface $method,
        private RequestObjectData $requestObject,
    ) {}

    public function handle(): array|ResponseData
    {
        try {
            $this->method->setRequest($this->requestObject);

            $result = App::call(
                // @phpstan-ignore-next-line
                [$this->method, 'handle'],
                [
                    'requestObject' => $this->requestObject,
                    ...$this->resolveParameters(
                        $this->method,
                        (array) $this->requestObject->getParam('data'),
                    ),
                ],
            );

            if ($this->method instanceof UnwrappedResponseInterface) {
                /** @var array $result */
                return $result;
            }

            return ResponseData::from([
                'jsonrpc' => $this->requestObject->jsonrpc,
                'id' => $this->requestObject->id,
                'result' => $result,
            ]);
        } catch (\Throwable $throwable) {
            return ResponseData::from([
                'jsonrpc' => '2.0',
                'id' => $this->requestObject->id,
                'error' => ExceptionMapper::execute($throwable)->toError(),
            ]);
        }
    }

    private function resolveParameters(MethodInterface $method, array $params): array
    {
        if (\count($params) < 1) {
            return [];
        }

        $parameters = (new \ReflectionClass($method))->getMethod('handle')->getParameters();
        $parametersMapped = [];

        foreach ($parameters as $parameter) {
            $parameterName = $parameter->getName();

            // This is an internal parameter, we don't want to map it.
            if ($parameterName === 'requestObject') {
                continue;
            }

            $parameterType = $parameter->getType();

            if ($parameterType instanceof \ReflectionNamedType) {
                $parameterType = $parameterType->getName();
            }

            $parameterValue = Arr::get($params, $parameterName) ?? Arr::get($params, Str::snake($parameterName, '.'));

            if (\is_subclass_of((string) $parameterType, Data::class)) {
                try {
                    $parametersMapped[$parameterName] = \call_user_func(
                        [(string) $parameterType, 'validateAndCreate'],
                        $parameter->getName() === 'data' ? $params : $parameterValue,
                    );
                } catch (ValidationException $exception) {
                    throw InvalidDataException::create($exception);
                }
            } elseif ($parameterType === 'array' && $parameter->getName() === 'data') {
                $parametersMapped[$parameterName] = $params;
            } else {
                $parametersMapped[$parameterName] = $parameterValue;
            }
        }

        return \array_filter($parametersMapped);
    }
}
