<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

use BaseCodeOy\Tonic\Contracts\ServerInterface;
// use BaseCodeOy\Tonic\Http\Middleware\BootServer;
// use Illuminate\Container\EntryNotFoundException;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Tests\Support\Fakes\Server;
use function Pest\Laravel\post;

beforeEach(function (): void {
    Route::rpc(Server::class);
});

it('binds ServerInterface to the container', function (): void {
    post(route('rpc'));

    expect(App::get(ServerInterface::class))->toBeInstanceOf(ServerInterface::class);
});

// it('removes ServerInterface from the container after request', function (): void {
//     $middleware = App::make(BootServer::class);

//     $request = Request::create('/rpc', 'GET', [], [], [], []);
//     $response = $middleware->handle($request, fn () => new Response());
//     $middleware->terminate($request, $response);

//     App::get(ServerInterface::class);
// })->throws(EntryNotFoundException::class);
