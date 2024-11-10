<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\OpenRPC\ContentDescriptors;

final class MethodDataContentDescriptor
{
    public static function create(array $schema): array
    {
        return [
            'name' => 'data',
            'description' => 'The data that will be passed to the method.',
            'schema' => $schema,
        ];
    }

    public static function createFromData(string $data): array
    {
        return self::create($data::getValidationRules([]));
    }
}
