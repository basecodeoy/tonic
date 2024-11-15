<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
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
