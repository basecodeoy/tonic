<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

use BaseCodeOy\Tonic\Data\ResourceObjectData;
use BaseCodeOy\Tonic\Normalizers\ModelNormalizer;
use BaseCodeOy\Tonic\Repositories\ResourceRepository;
use Carbon\CarbonImmutable;
use Tests\Support\Models\Post;
use Tests\Support\Models\User;
use Tests\Support\Resources\PostResource;
use Tests\Support\Resources\UserResource;

beforeEach(function (): void {
    ResourceRepository::register(Post::class, PostResource::class);
    ResourceRepository::register(User::class, UserResource::class);
});

it('transforms a model to a document data structure', function (): void {
    $user = User::create([
        'name' => 'John',
        'created_at' => CarbonImmutable::parse('01.01.2024'),
        'updated_at' => CarbonImmutable::parse('01.01.2024'),
    ]);

    Post::create([
        'user_id' => $user->id,
        'name' => 'John',
        'created_at' => CarbonImmutable::parse('01.01.2024'),
        'updated_at' => CarbonImmutable::parse('01.01.2024'),
    ]);

    $document = ModelNormalizer::normalize($user->load('posts'));

    expect($document)->toBeInstanceOf(ResourceObjectData::class);
    expect($document)->toMatchSnapshot();
});
