<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

use BaseCodeOy\Tonic\Contracts\ResourceInterface;
use BaseCodeOy\Tonic\Exceptions\InternalErrorException;
use BaseCodeOy\Tonic\Repositories\ResourceRepository;
use Tests\Support\Models\Post;
use Tests\Support\Models\User;
use Tests\Support\Resources\PostResource;
use Tests\Support\Resources\UserResource;

it('registers and retrieves a resource', function (): void {
    ResourceRepository::register(User::class, UserResource::class);

    $resource = ResourceRepository::get(new User());

    expect($resource)->toBeInstanceOf(ResourceInterface::class);
    expect($resource)->toBeInstanceOf(UserResource::class);
});

it('throws an exception when a resource is not found for a model', function (): void {
    ResourceRepository::forget(User::class);

    ResourceRepository::get(new User());
})->throws(InternalErrorException::class);

it('retrieves all registered resources', function (): void {
    ResourceRepository::register(Post::class, PostResource::class);
    ResourceRepository::register(User::class, UserResource::class);

    $resources = ResourceRepository::all();

    expect($resources)->toHaveCount(2);
    expect($resources)->toHaveKey(Post::class);
    expect($resources)->toHaveKey(User::class);
});
