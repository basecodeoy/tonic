<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Tonic\Http\Middleware;

use BaseCodeOy\Tonic\Contracts\ServerInterface;
use BaseCodeOy\Tonic\Repositories\ServerRepository;
use Illuminate\Container\Container;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final readonly class BootServer
{
    public function __construct(
        private readonly Container $container,
        private readonly ServerRepository $serverRepository,
    ) {}

    public function handle(Request $request, \Closure $next): JsonResponse
    {
        $routeName = $request->route()?->getName();

        if ($routeName === null) {
            throw new BadRequestHttpException('A route name is required to boot the server.');
        }

        $this->container->instance(
            ServerInterface::class,
            $this->serverRepository->findByName($routeName),
        );

        return $next($request);
    }

    public function terminate(): void
    {
        if (App::runningUnitTests()) {
            return;
        }

        $this->container->forgetInstance(ServerInterface::class);
    }
}
