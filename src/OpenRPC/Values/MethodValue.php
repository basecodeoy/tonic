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
use Spatie\LaravelData\Optional;

/**
 * @see https://spec.open-rpc.org/#method-object
 */
final class MethodValue extends AbstractData
{
    public function __construct(
        #[Required()]
        public readonly string $name,
        #[DataCollectionOf(TagValue::class)]
        public readonly ?DataCollection $tags,
        public readonly ?string $summary,
        public readonly ?string $description,
        public readonly ?ExternalDocumentationValue $externalDocs,
        #[DataCollectionOf(ContentDescriptorValue::class)]
        #[Required()]
        public readonly ?DataCollection $params,
        public readonly ?ContentDescriptorValue $result,
        public readonly bool|Optional $deprecated,
        #[DataCollectionOf(ServerValue::class)]
        public readonly ?DataCollection $servers,
        #[DataCollectionOf(ErrorValue::class)]
        public readonly ?DataCollection $errors,
        #[DataCollectionOf(LinkValue::class)]
        public readonly ?DataCollection $links,
        public readonly ?string $paramStructure,
        #[DataCollectionOf(ExamplePairingValue::class)]
        public readonly ?DataCollection $examples,
    ) {}
}
