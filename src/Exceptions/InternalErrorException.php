<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Tonic\Exceptions;

final class InternalErrorException extends AbstractRequestException
{
    public static function create(\Throwable $exception): self
    {
        return self::new(-32_603, 'Internal error', [
            [
                'status' => '500',
                'title' => 'Internal error',
                'detail' => $exception->getMessage(),
            ],
        ]);
    }
}
