<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
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
