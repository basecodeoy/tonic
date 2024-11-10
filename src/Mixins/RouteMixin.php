<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\Mixins;

use BaseCodeOy\Tonic\Contracts\ServerInterface;
use BaseCodeOy\Tonic\Http\Controllers\MethodController;
use BaseCodeOy\Tonic\Repositories\ServerRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

final readonly class RouteMixin
{
    public function rpc(): \Closure
    {
        /**
         * @param class-string<ServerInterface> $server
         */
        return function (string|ServerInterface $server): void {
            if (\is_string($server)) {
                /** @var ServerInterface $server */
                $server = App::make($server);
            }

            App::make(ServerRepository::class)->register($server);

            Route::post($server->getRoutePath(), MethodController::class)
                ->name($server->getRouteName())
                ->middleware($server->getMiddleware());
        };
    }
}
