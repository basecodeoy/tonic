<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Support\Resources;

use BaseCodeOy\Tonic\Resources\AbstractModelResource;
use Tests\Support\Models\User;

final class UserResource extends AbstractModelResource
{
    #[\Override()]
    public static function getModel(): string
    {
        return User::class;
    }

    #[\Override()]
    public static function getFields(): array
    {
        return [
            'self' => ['id', 'name'],
            'posts' => ['id', 'name'],
        ];
    }

    #[\Override()]
    public static function getFilters(): array
    {
        return [
            'self' => ['id', 'name'],
            'posts' => ['id', 'name'],
        ];
    }

    #[\Override()]
    public static function getRelationships(): array
    {
        return [
            'self' => ['posts'],
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
