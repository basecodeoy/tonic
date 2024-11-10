<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\JsonSchema;

final class RulesTransformer
{
    public static function transform(array $rules, array $properties = []): array
    {
        $schema = [
            'type' => 'object',
            'properties' => [],
            'required' => [],
        ];

        foreach ($rules as $field => $fieldRules) {
            $parsedRules = \is_string($fieldRules) ? \explode('|', $fieldRules) : $fieldRules;

            $fieldSchema = RuleTransformer::transform($field, $parsedRules);

            if ($fieldSchema !== []) {
                if (!empty($fieldSchema['required'])) {
                    $schema['required'][] = $field;

                    if ($fieldSchema['type'] !== 'object') {
                        unset($fieldSchema['required']);
                    }
                }

                $schema['properties'][$field] = $fieldSchema;
            }
        }

        foreach ($properties as $field => $fieldSchema) {
            $schema['properties'][$field] = \array_merge($schema['properties'][$field] ?? [], $fieldSchema);
        }

        return $schema;
    }

    public static function transformDataObject(string $data, array $properties = []): array
    {
        return self::transform($data::getValidationRules([]), $properties);
    }
}
