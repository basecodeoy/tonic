<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\Repositories;

use BaseCodeOy\Tonic\Contracts\ServerInterface;
use BaseCodeOy\Tonic\Exceptions\ServerNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;

final class ServerRepository
{
    private Collection $servers;

    public function __construct()
    {
        $this->servers = new Collection();
    }

    /**
     * @return Collection<int, ServerInterface>
     */
    public function all(): Collection
    {
        return $this->servers;
    }

    public function findByName(string $name): ServerInterface
    {
        return $this->findBy(fn (ServerInterface $server): bool => $server->getRouteName() === $name);
    }

    public function findByPath(string $path): ServerInterface
    {
        return $this->findBy(fn (ServerInterface $server): bool => $server->getRoutePath() === $path);
    }

    public function register(string|ServerInterface $server): void
    {
        if (\is_string($server)) {
            /** @var ServerInterface $server */
            $server = App::make($server);
        }

        $this->servers[$server->getRoutePath()] = $server;
    }

    private function findBy(\Closure $closure): ServerInterface
    {
        $server = $this->servers->firstWhere(
            $closure,
            fn () => throw ServerNotFoundException::create(),
        );

        if ($server instanceof ServerInterface) {
            return $server;
        }

        throw ServerNotFoundException::create();
    }
}
