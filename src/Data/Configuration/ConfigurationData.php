<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
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
