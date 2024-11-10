<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\Data;

use Spatie\LaravelData\Data;

abstract class AbstractData extends Data
{
    #[\Override()]
    public function toArray(): array
    {
        return $this->removeNullValuesRecursively(parent::toArray());
    }

    #[\Override()]
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * Recursively remove null values from an array. This is useful for adhering
     * to the JSON:API and JSON-RPC specifications.
     *
     * Keys MUST either be omitted or have a null value to indicate that a
     * particular link is unavailable.
     */
    private function removeNullValuesRecursively(array $array): array
    {
        foreach ($array as $key => $value) {
            if ($value === null) {
                unset($array[$key]);

                continue;
            }

            if (\is_array($value)) {
                $array[$key] = $this->removeNullValuesRecursively($value);
            }
        }

        return $array;
    }
}
