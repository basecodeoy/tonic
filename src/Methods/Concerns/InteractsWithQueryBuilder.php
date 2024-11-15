<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
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
