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
 * @see https://spec.open-rpc.org/#server-object
 */
final class ServerValue extends AbstractData
{
    public function __construct(
        #[Required()]
        public readonly string $name,
        #[Required()]
        public readonly string $url,
        public readonly ?string $summary,
        public readonly ?string $description,
        #[DataCollectionOf(ServerVariableValue::class)]
        public readonly ?DataCollection $variables,
    ) {}
}
