<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\Exceptions;

final class InvalidParamsException extends AbstractRequestException
{
    public static function create(?array $data = null): self
    {
        return self::new(-32_602, 'Invalid params', $data);
    }
}
