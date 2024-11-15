<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Tonic\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Support\ItemNotFoundException;
use Illuminate\Validation\ValidationException;

final class ExceptionMapper
{
    public static function execute(\Throwable $exception): AbstractRequestException
    {
        return match (true) {
            $exception instanceof AbstractRequestException => $exception,
            $exception instanceof AuthenticationException => UnauthorizedException::create(),
            $exception instanceof AuthorizationException => ForbiddenException::create(),
            $exception instanceof ItemNotFoundException => ResourceNotFoundException::create(),
            $exception instanceof ModelNotFoundException => ResourceNotFoundException::create(),
            $exception instanceof ThrottleRequestsException => TooManyRequestsException::create(),
            $exception instanceof ValidationException => UnprocessableEntityException::createFromValidationException($exception),
            default => InternalErrorException::create($exception),
        };
    }
}
