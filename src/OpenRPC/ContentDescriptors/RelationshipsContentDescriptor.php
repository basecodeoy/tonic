<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
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
