<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\Exceptions;

use Illuminate\Support\Arr;

final class InvalidSortsException extends AbstractRequestException
{
    public static function create(array $unknownSorts, array $allowedSorts): self
    {
        $unknownSorts = Arr::pluck($unknownSorts, 'attribute');
        $unknownSorts = \implode(', ', \array_diff($unknownSorts, $allowedSorts));

        $allowedSorts = \implode(', ', $allowedSorts);

        return self::new(-32_602, 'Invalid params', [
            [
                'status' => '422',
                'source' => ['pointer' => '/params/sorts'],
                'title' => 'Invalid sorts',
                'detail' => \sprintf('Requested sorts `%s` is not allowed. Allowed sorts are `%s`.', $unknownSorts, $allowedSorts),
                'meta' => [
                    'unknown' => $unknownSorts,
                    'allowed' => $allowedSorts,
                ],
            ],
        ]);
    }
}
