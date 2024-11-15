<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Tonic\OpenRPC\ContentDescriptors;

final class FiltersContentDescriptor
{
    public static function create(array $filters): ?array
    {
        $properties = [];

        foreach ($filters as $resource => $resourceFilters) {
            $properties[$resource] = [
                'name' => $resource,
                'type' => 'array',
                'items' => [
                    'type' => 'string',
                    'enum' => $resourceFilters,
                ],
            ];
        }

        if ($properties === []) {
            return null;
        }

        return [
            'name' => 'filters',
            'description' => 'The filters to apply to the resources. If not specified, no filters are applied.',
            'schema' => [
                'type' => 'object',
                'properties' => $properties,
            ],
        ];
    }
}
