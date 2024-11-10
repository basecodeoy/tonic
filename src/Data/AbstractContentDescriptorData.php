<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
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
