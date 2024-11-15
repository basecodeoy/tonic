<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Tonic\Exceptions;

final class ResourceNotFoundException extends AbstractRequestException
{
    public static function create(?string $detail = null): self
    {
        return self::new(-32_000, 'Server error', [
            [
                'status' => '404',
                'title' => 'Resource Not Found',
                'detail' => $detail ?? 'The requested model could not be found.',
            ],
        ]);
    }

    #[\Override()]
    public function getStatusCode(): int
    {
        return 404;
    }
}
