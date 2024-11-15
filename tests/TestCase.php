<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests;

use BaseCodeOy\Tonic\ServiceProvider;
use Illuminate\Bus\BusServiceProvider;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\LaravelData\LaravelDataServiceProvider;
use Spatie\LaravelRay\RayServiceProvider;

/**
 * @internal
 */
abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * {@inheritDoc}
     */
    #[\Override()]
    protected function getEnvironmentSetUp($app): void
    {
        $app->config->set('app.key', 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA');
        $app->config->set('tonic.servers', []);

        $app->config->set('cache.driver', 'array');

        $app->config->set('database.default', 'sqlite');
        $app->config->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        $app->config->set('mail.driver', 'log');

        $app->config->set('session.driver', 'array');

        $app->useStoragePath(\realpath(__DIR__.'/storage'));

        Schema::create('users', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Application                                       $app
     * @return array<int, class-string<\Illuminate\Support\ServiceProvider>>
     */
    #[\Override()]
    protected function getPackageProviders($app)
    {
        return [
            BusServiceProvider::class,
            RayServiceProvider::class,
            LaravelDataServiceProvider::class,
            ServiceProvider::class,
        ];
    }
}
