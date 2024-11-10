<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\Servers;

use BaseCodeOy\Tonic\Contracts\MethodInterface;
use BaseCodeOy\Tonic\Data\Configuration\ServerData;
use Illuminate\Support\Facades\File;

final class ConfigurationServer extends AbstractServer
{
    public function __construct(
        private readonly ServerData $server,
    ) {
        parent::__construct();
    }

    #[\Override()]
    public function getName(): string
    {
        return $this->server->name;
    }

    #[\Override()]
    public function getRoutePath(): string
    {
        return $this->server->path;
    }

    #[\Override()]
    public function getRouteName(): string
    {
        return $this->server->route;
    }

    #[\Override()]
    public function getVersion(): string
    {
        return $this->server->version;
    }

    #[\Override()]
    public function getMiddleware(): array
    {
        return $this->server->middleware;
    }

    #[\Override()]
    public function methods(): array
    {
        return once(function (): array {
            $methods = $this->server->methods;

            if ($methods === null) {
                $methodsPath = (string) config('tonic.paths.methods');
                $methodsNamespace = (string) config('tonic.namespaces.methods');

                return collect(File::allFiles($methodsPath))
                    ->map(fn ($file): string => $file->getPathname())
                    ->map(fn ($file): string => \str_replace($methodsPath, $methodsNamespace, $file))
                    ->map(fn ($file): string => \str_replace('.php', '', $file))
                    ->map(fn ($file): string => \str_replace('/', '\\', $file))
                    ->map(fn ($file): string => \ucfirst($file))
                    ->reject(fn ($file): bool => \str_contains($file, 'Abstract'))
                    ->reject(fn ($file): bool => !\in_array(MethodInterface::class, (array) \class_implements($file), true))
                    ->toArray();
            }

            return $methods;
        });
    }

    #[\Override()]
    public function getContentDescriptors(): array
    {
        return $this->server->content_descriptors;
    }

    #[\Override()]
    public function getSchemas(): array
    {
        return $this->server->schemas;
    }
}
