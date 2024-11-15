<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Tonic\Exceptions;

final class MethodNotFoundException extends AbstractRequestException
{
    public static function create(?array $data = null): self
    {
        return self::new(-32_601, 'Method not found', $data);
    }
}
