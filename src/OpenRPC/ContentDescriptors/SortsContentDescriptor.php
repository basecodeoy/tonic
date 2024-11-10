<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\OpenRPC\ContentDescriptors;

use Illuminate\Support\Arr;

final class SortsContentDescriptor
{
    public static function create(array $sorts): ?array
    {
        $properties = [];

        foreach ($sorts as $resource => $resourceSorts) {
            $properties[$resource] = [
                'type' => 'array',
                'items' => [
                    'type' => 'string',
                    'enum' => [
                        ...$resourceSorts,
                        ...Arr::map($resourceSorts, fn ($sort): string => '-'.$sort),
                    ],
                ],
            ];
        }

        if ($properties === []) {
            return null;
        }

        return [
            'name' => 'sorts',
            'description' => 'The sort order of the resources. The order of the fields matter, the first fields have the highest priority. Prefix with "-" to sort in descending order. If not specified, the default sort order is used.',
            'schema' => [
                'type' => 'object',
                'properties' => $properties,
            ],
        ];
    }
}
