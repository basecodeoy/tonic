<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Tonic\Exceptions;

final class InvalidRelationshipsException extends AbstractRequestException
{
    public static function create(array $unknownRelationships, array $allowedRelationships): self
    {
        $unknownRelationships = \implode(', ', \array_diff($unknownRelationships, $allowedRelationships));

        $message = \sprintf('Requested relationships `%s` are not allowed. ', $unknownRelationships);

        if ($allowedRelationships !== []) {
            $allowedRelationships = \implode(', ', $allowedRelationships);
            $message .= \sprintf('Allowed relationships are `%s`.', $allowedRelationships);
        } else {
            $message .= 'There are no allowed relationships.';
        }

        return self::new(-32_602, 'Invalid params', [
            [
                'status' => '422',
                'source' => ['pointer' => '/params/relationships'],
                'title' => 'Invalid relationships',
                'detail' => $message,
                'meta' => [
                    'unknown' => $unknownRelationships,
                    'allowed' => $allowedRelationships,
                ],
            ],
        ]);
    }
}
