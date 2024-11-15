<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
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
