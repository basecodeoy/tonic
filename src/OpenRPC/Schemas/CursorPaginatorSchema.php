<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\OpenRPC\Schemas;

final class CursorPaginatorSchema
{
    public static function create(): array
    {
        return [
            'name' => 'CursorPaginator',
            'data' => [
                'type' => 'object',
                'required' => ['cursor'],
                'properties' => [
                    'cursor' => [
                        'type' => 'string',
                        'description' => 'The cursor to start from. If not specified, the first page is returned.',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'description' => 'The number of items to return per page. If not specified, the default page size is used.',
                    ],
                ],
            ],
        ];
    }
}
