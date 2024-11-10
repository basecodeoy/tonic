<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\Data\Requests;

use BaseCodeOy\Tonic\Data\AbstractData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\DataCollection;

final class ListRequestData extends AbstractData
{
    public function __construct(
        public readonly ?array $fields,
        #[DataCollectionOf(FilterData::class)]
        public readonly ?DataCollection $filters,
        public readonly ?array $relationships,
        #[DataCollectionOf(SortData::class)]
        public readonly ?DataCollection $sorts,
    ) {}
}
