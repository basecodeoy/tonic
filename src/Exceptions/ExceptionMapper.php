<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
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
