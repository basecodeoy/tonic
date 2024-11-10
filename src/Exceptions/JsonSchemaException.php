<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\Exceptions;

final class JsonSchemaException extends AbstractRequestException
{
    public static function invalidRule(string $rule): self
    {
        return self::new(-32_603, 'Internal error', [
            [
                'status' => '418',
                'source' => ['pointer' => '/'],
                'title' => 'Invalid JSON Schema',
                'detail' => \sprintf("The '%s' rule is not supported.", $rule),
            ],
        ]);
    }
}
