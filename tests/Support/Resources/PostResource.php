<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace Tests\Support\Resources;

use BaseCodeOy\Tonic\Resources\AbstractModelResource;
use Tests\Support\Models\Post;

final class PostResource extends AbstractModelResource
{
    #[\Override()]
    public static function getModel(): string
    {
        return Post::class;
    }

    #[\Override()]
    public static function getFields(): array
    {
        return [
            'self' => ['id', 'name'],
            'user' => ['id', 'name'],
        ];
    }

    #[\Override()]
    public static function getFilters(): array
    {
        return [
            'self' => ['id', 'name'],
            'user' => ['id', 'name'],
        ];
    }

    #[\Override()]
    public static function getRelationships(): array
    {
        return [
            'self' => ['user'],
        ];
    }

    #[\Override()]
    public static function getSorts(): array
    {
        return [
            'self' => ['created_at'],
        ];
    }
}