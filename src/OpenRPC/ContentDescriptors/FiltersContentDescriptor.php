<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
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
