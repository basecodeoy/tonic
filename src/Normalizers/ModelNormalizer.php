<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Tonic\Normalizers;

use BaseCodeOy\Tonic\Data\ResourceObjectData;
use BaseCodeOy\Tonic\Repositories\ResourceRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

final readonly class ModelNormalizer
{
    public static function normalize(Model $model): ResourceObjectData
    {
        $resource = ResourceRepository::get($model);
        $pendingResourceObject = $resource->toArray();

        foreach ($resource->getRelations() as $relationName => $relationModels) {
            if ($relationModels === null) {
                continue;
            }

            $isOneToOne = $relationModels instanceof Model;

            if ($isOneToOne) {
                $relationModels = Arr::wrap($relationModels);
            }

            /** @var Model $relationModel */
            foreach ($relationModels as $relationModel) {
                $relationship = ResourceRepository::get($relationModel)->toArray();

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
