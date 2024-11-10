<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\Facades;

use BaseCodeOy\Tonic\Contracts\ServerInterface;
use BaseCodeOy\Tonic\OpenRPC\Values\ContentDescriptorValue;
use BaseCodeOy\Tonic\OpenRPC\Values\SchemaValue;
use BaseCodeOy\Tonic\Repositories\MethodRepository;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array<ContentDescriptorValue> getContentDescriptors()
 * @method static MethodRepository              getMethodRepository()
 * @method static array                         getMiddleware()
 * @method static string                        getName()
 * @method static string                        getRouteName()
 * @method static string                        getRoutePath()
 * @method static array<SchemaValue>            getSchemas()
 * @method static string                        getVersion()
 */
final class Server extends Facade
{
    #[\Override()]
    protected static function getFacadeAccessor(): string
    {
        return ServerInterface::class;
    }
}
