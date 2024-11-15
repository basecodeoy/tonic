<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
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
