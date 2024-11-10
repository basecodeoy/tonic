<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\Exceptions;

final class InvalidFiltersException extends AbstractRequestException
{
    public static function create(array $unknownFilters, array $allowedFilters): self
    {
        $unknownFilters = \implode(', ', \array_diff($unknownFilters, $allowedFilters));
        $allowedFilters = \implode(', ', $allowedFilters);

        return self::new(-32_602, 'Invalid params', [
            [
                'status' => '422',
                'source' => ['pointer' => '/params/filters'],
                'title' => 'Invalid filters',
                'detail' => \sprintf('Requested filters `%s` are not allowed. Allowed filters are `%s`.', $unknownFilters, $allowedFilters),
                'meta' => [
                    'unknown' => $unknownFilters,
                    'allowed' => $allowedFilters,
                ],
            ],
        ]);
    }
}
