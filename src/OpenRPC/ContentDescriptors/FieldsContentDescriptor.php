<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
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
