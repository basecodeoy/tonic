<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Tonic\Data;

use BaseCodeOy\Data\AbstractData;
use BaseCodeOy\Tonic\OpenRPC\ContentDescriptors\MethodDataContentDescriptor;

abstract class AbstractContentDescriptorData extends AbstractData
{
    public static function createContentDescriptor(): array
    {
        return MethodDataContentDescriptor::createFromData(self::class);
    }

    protected static function defaultContentDescriptors(): array
    {
        return [];
    }
}
