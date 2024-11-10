<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

use BaseCodeOy\Tonic\Contracts\ServerInterface;
use BaseCodeOy\Tonic\Facades\Server;
use BaseCodeOy\Tonic\Repositories\MethodRepository;
use Illuminate\Support\Facades\App;
use Tests\Support\Fakes\Server as FakesServer;

it('retrieves content descriptors', function (): void {
    App::instance(ServerInterface::class, new FakesServer());

    expect(Server::getContentDescriptors())->toBeArray();
});

it('retrieves the method repository', function (): void {
    App::instance(ServerInterface::class, new FakesServer());

    $repository = Server::getMethodRepository();

    expect($repository)->toBeInstanceOf(MethodRepository::class);
});

it('retrieves middleware', function (): void {
    App::instance(ServerInterface::class, new FakesServer());

    $retrievedMiddleware = Server::getMiddleware();

    expect($retrievedMiddleware)->toBeArray();
});

it('retrieves the name', function (): void {
    App::instance(ServerInterface::class, new FakesServer());

    $retrievedName = Server::getName();

    expect($retrievedName)->toBeString();
});

it('retrieves the route name', function (): void {
    App::instance(ServerInterface::class, new FakesServer());

    $retrievedRouteName = Server::getRouteName();

    expect($retrievedRouteName)->toBeString();
});

it('retrieves the route path', function (): void {
    App::instance(ServerInterface::class, new FakesServer());

    $retrievedRoutePath = Server::getRoutePath();

    expect($retrievedRoutePath)->toBeString();
});

it('retrieves schemas', function (): void {
    App::instance(ServerInterface::class, new FakesServer());

    $retrievedSchemas = Server::getSchemas();

    expect($retrievedSchemas)->toBeArray();
});

it('retrieves the version', function (): void {
    App::instance(ServerInterface::class, new FakesServer());

    $retrievedVersion = Server::getVersion();

    expect($retrievedVersion)->toBeString();
});
