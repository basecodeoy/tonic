<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\Exceptions;

final class InternalErrorException extends AbstractRequestException
{
    public static function create(\Throwable $exception): self
    {
        return self::new(-32_603, 'Internal error', [
            [
                'status' => '500',
                'title' => 'Internal error',
                'detail' => $exception->getMessage(),
            ],
        ]);
    }
}