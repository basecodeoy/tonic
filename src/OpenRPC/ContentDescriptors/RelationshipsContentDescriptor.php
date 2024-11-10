<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\OpenRPC\ContentDescriptors;

final class RelationshipsContentDescriptor
{
    public static function create(array $relationships): ?array
    {
        $properties = [];

        foreach ($relationships as $resource => $resourceRelationships) {
            $properties[$resource] = [
                'type' => 'array',
                'items' => [
                    'type' => 'string',
                    'enum' => $resourceRelationships,
                ],
            ];
        }

        if ($properties === []) {
            return null;
        }

        return [
            'name' => 'relationships',
            'description' => 'The relationships to return for each resource. If not specified, no relationships will be returned.',
            'schema' => [
                'type' => 'object',
                'properties' => $properties,
            ],
        ];
    }
}
