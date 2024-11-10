<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\OpenRPC\ContentDescriptors;

final class CursorPaginatorContentDescriptor
{
    public static function create(): array
    {
        return [
            'name' => 'page',
            'description' => 'The page to return. If not specified, the first page is returned.',
            'schema' => [
                '$ref' => '#/components/schemas/CursorPaginator',
            ],
        ];
    }
}
