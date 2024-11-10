<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\OpenRPC\ContentDescriptors;

final class FieldsContentDescriptor
{
    public static function create(array $fields): ?array
    {
        $properties = [];

        foreach ($fields as $resource => $resourceFields) {
            $properties[$resource] = [
                'name' => $resource,
                'type' => 'array',
                'items' => [
                    'type' => 'string',
                    'enum' => $resourceFields,
                ],
            ];
        }

        if ($properties === []) {
            return null;
        }

        return [
            'name' => 'fields',
            'description' => 'The fields to return for each resource. If not specified, all fields are returned.',
            'schema' => [
                'type' => 'object',
                'properties' => $properties,
            ],
        ];
    }
}
