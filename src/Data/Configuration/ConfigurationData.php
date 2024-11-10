<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\Data\Configuration;

use BaseCodeOy\Tonic\Data\AbstractData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\Present;
use Spatie\LaravelData\DataCollection;

final class ConfigurationData extends AbstractData
{
    public function __construct(
        public readonly array $namespaces,
        public readonly array $paths,
        #[Present()]
        public readonly array $resources,
        #[DataCollectionOf(ServerData::class)]
        public readonly DataCollection $servers,
    ) {}
}
