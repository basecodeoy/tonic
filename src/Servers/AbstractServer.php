<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Tonic\Servers;

use BaseCodeOy\Tonic\Contracts\ServerInterface;
use BaseCodeOy\Tonic\Http\Middleware\BootServer;
use BaseCodeOy\Tonic\Http\Middleware\ForceJson;
use BaseCodeOy\Tonic\Methods\DiscoverMethod;
use BaseCodeOy\Tonic\OpenRPC\ContentDescriptors\CursorPaginatorContentDescriptor;
use BaseCodeOy\Tonic\OpenRPC\Schemas\CursorPaginatorSchema;
use BaseCodeOy\Tonic\Repositories\MethodRepository;
use Illuminate\Support\Facades\Config;

abstract class AbstractServer implements ServerInterface
{
    private readonly MethodRepository $methodRepository;

    public function __construct()
    {
        $this->methodRepository = new MethodRepository($this->methods());
        $this->methodRepository->register(DiscoverMethod::class);
    }

    #[\Override()]
    public function getName(): string
    {
        return (string) Config::get('app.name');
    }

    #[\Override()]
    public function getRoutePath(): string
    {
        return '/rpc';
    }

    #[\Override()]
    public function getRouteName(): string
    {
        return 'rpc';
    }

    #[\Override()]
    public function getVersion(): string
    {
        return '1.0.0';
    }

    #[\Override()]
    public function getMiddleware(): array
    {
        return [
            ForceJson::class,
            BootServer::class,
        ];
    }

    #[\Override()]
    public function getMethodRepository(): MethodRepository
    {
        return $this->methodRepository;
    }

    #[\Override()]
    public function getContentDescriptors(): array
    {
        return [
            CursorPaginatorContentDescriptor::create(),
        ];
    }

    #[\Override()]
    public function getSchemas(): array
    {
        return [
            CursorPaginatorSchema::create(),
        ];
    }

    abstract public function methods(): array;
}
