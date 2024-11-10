<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\OpenRPC\Values;

use BaseCodeOy\Tonic\Data\AbstractData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\DataCollection;

/**
 * @see https://spec.open-rpc.org/#example-pairing-object
 */
final class ExamplePairingValue extends AbstractData
{
    public function __construct(
        #[Required()]
        public readonly string $name,
        public readonly ?string $description,
        public readonly ?string $summary,
        #[DataCollectionOf(ExampleValue::class)]
        #[Required()]
        public readonly DataCollection $params,
        #[DataCollectionOf(ExampleValue::class)]
        public readonly ?DataCollection $result,
    ) {}
}
