<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Tonic\Normalizers;

use BaseCodeOy\Tonic\Contracts\ResourceInterface;
use BaseCodeOy\Tonic\Data\ResourceObjectData;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

final readonly class ResourceNormalizer
{
    public static function normalize(ResourceInterface $resource): ResourceObjectData
    {
        $pendingResourceObject = $resource->toArray();

        foreach ($resource->getRelations() as $relationName => $relationModels) {
            $isOneToOne = Str::plural($relationName) !== $relationName;

            if ($isOneToOne) {
                $relationModels = Arr::wrap($relationModels);
            }

            /** @var ResourceInterface $relationship */
            foreach ($relationModels as $relationship) {
                if ($isOneToOne) {
                    $pendingResourceObject['relationships'][$relationName] = $relationship;
                } else {
                    $pendingResourceObject['relationships'][$relationName][] = $relationship;
                }
            }
        }

        return ResourceObjectData::from($pendingResourceObject);
    }
}
