<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
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
