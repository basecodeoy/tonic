<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\Exceptions;

final class UnauthorizedException extends AbstractRequestException
{
    public static function create(?string $detail = null): self
    {
        return self::new(-32_000, 'Server error', [
            [
                'status' => '401',
                'title' => 'Unauthorized',
                'detail' => $detail ?? 'You are not authorized to perform this action.',
            ],
        ]);
    }

    #[\Override()]
    public function getStatusCode(): int
    {
        return 401;
    }
}
