<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
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
