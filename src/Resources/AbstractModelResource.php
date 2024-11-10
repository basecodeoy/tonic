<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\Resources;

use BaseCodeOy\Tonic\Data\RequestObjectData;
use BaseCodeOy\Tonic\QueryBuilders\QueryBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

abstract class AbstractModelResource extends AbstractResource
{
    public function __construct(
        private readonly Model $model,
    ) {}

    public static function query(RequestObjectData $request): QueryBuilder
    {
        return QueryBuilder::for(
            resource: static::class,
            requestFields: (array) $request->getParam('fields', []),
            allowedFields: static::getFields(),
            requestFilters: (array) $request->getParam('filters', []),
            allowedFilters: static::getFilters(),
            requestRelationships: (array) $request->getParam('relationships', []),
            allowedRelationships: static::getRelationships(),
            requestSorts: (array) $request->getParam('sorts', []),
            allowedSorts: static::getSorts(),
        );
    }

    /**
     * The model's fully qualified class name.
     */
    public static function getModel(): string
    {
        return \sprintf(
            'App\\Models\\%s',
            Str::beforeLast(class_basename(static::class), 'Resource'),
        );
    }

    /**
     * The model's table name.
     */
    public static function getModelTable(): string
    {
        return app(static::getModel())->getTable();
    }

    /**
     * The model's type. This is the singular form of the model's table name.
     */
    public static function getModelType(): string
    {
        return Str::singular(static::getModelTable());
    }

    #[\Override()]
    public function getType(): string
    {
        return Str::singular(static::getModelTable());
    }

    #[\Override()]
    public function getId(): string
    {
        // @phpstan-ignore-next-line
        return (string) $this->model->id;
    }

    #[\Override()]
    public function getAttributes(): array
    {
        $rawAttributes = $this->model->toArray();

        $attributes = Arr::only($rawAttributes, static::getFields()['self']);

        Arr::forget($attributes, 'id');

        foreach (\array_keys($this->getRelations()) as $relation) {
            if (Arr::has($attributes, $relation)) {
                Arr::forget($attributes, $relation);
            }
        }

        return $attributes;
    }

    #[\Override()]
    public function getRelations(): array
    {
        return $this->model->getRelations();
    }
}
