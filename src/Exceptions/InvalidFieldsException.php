<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Tonic\Exceptions;

final class InvalidFieldsException extends AbstractRequestException
{
    public static function create(array $unknownFields, array $allowedFields): self
    {
        $unknownFields = \implode(', ', \array_diff($unknownFields, $allowedFields));
        $allowedFields = \implode(', ', $allowedFields);

        return self::new(-32_602, 'Invalid params', [
            [
                'status' => '422',
                'source' => ['pointer' => '/params/fields'],
                'title' => 'Invalid fields',
                'detail' => \sprintf('Requested fields `%s` are not allowed. Allowed fields are `%s`.', $unknownFields, $allowedFields),
                'meta' => [
                    'unknown' => $unknownFields,
                    'allowed' => $allowedFields,
                ],
            ],
        ]);
    }
}
