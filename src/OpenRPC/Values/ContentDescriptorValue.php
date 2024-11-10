<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\OpenRPC\Values;

use BaseCodeOy\Tonic\Data\AbstractData;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Optional;

/**
 * @see https://spec.open-rpc.org/#content-descriptor-object
 */
final class ContentDescriptorValue extends AbstractData
{
    public function __construct(
        #[Required()]
        public readonly string $name,
        public readonly ?string $summary,
        public readonly ?string $description,
        public readonly bool|Optional $required,
        // public readonly ?SchemaValue $schema,
        public readonly ?array $schema,
        public readonly bool|Optional $deprecated,
    ) {}
}