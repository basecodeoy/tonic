<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic;

use BaseCodeOy\Tonic\Data\Configuration\ConfigurationData;
use BaseCodeOy\Tonic\Mixins\RouteMixin;
use BaseCodeOy\Tonic\Repositories\ResourceRepository;
use BaseCodeOy\Tonic\Repositories\ServerRepository;
use BaseCodeOy\Tonic\Requests\RequestHandler;
use BaseCodeOy\Tonic\Servers\ConfigurationServer;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

final class ServiceProvider extends PackageServiceProvider
{
    #[\Override()]
    public function configurePackage(Package $package): void
    {
        $package
            ->name('tonic')
            ->hasConfigFile()
            ->hasInstallCommand(function (InstallCommand $command): void {
                $command->publishConfigFile();
                $command->publishMigrations();
            });
    }

    #[\Override()]
    public function packageRegistered(): void
    {
        $this->app->singleton(ServerRepository::class);
        $this->app->singleton(RequestHandler::class);
    }

    #[\Override()]
    public function bootingPackage(): void
    {
        Route::mixin(new RouteMixin());
    }

    #[\Override()]
    public function packageBooted(): void
    {
        try {
            $configuration = ConfigurationData::validateAndCreate((array) config('tonic'));

            foreach ($configuration->resources as $model => $resource) {
                ResourceRepository::register($model, $resource);
            }

            foreach ($configuration->servers as $server) {
                // @phpstan-ignore-next-line
                Route::rpc(new ConfigurationServer($server));
            }
        } catch (\Throwable $throwable) {
            if (App::runningInConsole()) {
                return;
            }

            throw $throwable;
        }
    }
}
