<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\Methods\Concerns;

use BaseCodeOy\Tonic\Data\RequestObjectData;
use BaseCodeOy\Tonic\QueryBuilders\QueryBuilder;

/**
 * @property RequestObjectData $requestObject
 */
trait InteractsWithQueryBuilder
{
    protected function query(string $class): QueryBuilder
    {
        return $class::query($this->requestObject);
    }
}
