<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\Methods\Concerns;

use BaseCodeOy\Tonic\Contracts\ResourceInterface;
use BaseCodeOy\Tonic\Data\DocumentData;
use BaseCodeOy\Tonic\Data\RequestObjectData;
use BaseCodeOy\Tonic\QueryBuilders\QueryBuilder;
use BaseCodeOy\Tonic\Transformers\Transformer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property RequestObjectData $requestObject
 */
trait InteractsWithTransformer
{
    protected function item(Model|ResourceInterface $item): DocumentData
    {
        return Transformer::create($this->requestObject)->item($item);
    }

    protected function collection(Collection $collection): DocumentData
    {
        return Transformer::create($this->requestObject)->collection($collection);
    }

    protected function cursorPaginate(Builder|QueryBuilder $query): DocumentData
    {
        return Transformer::create($this->requestObject)->cursorPaginate($query);
    }

    protected function paginate(Builder|QueryBuilder $query): DocumentData
    {
        return Transformer::create($this->requestObject)->paginate($query);
    }

    protected function simplePaginate(Builder|QueryBuilder $query): DocumentData
    {
        return Transformer::create($this->requestObject)->simplePaginate($query);
    }
}
