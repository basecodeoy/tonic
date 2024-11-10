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

/**
 * @see https://spec.open-rpc.org/#server-variable-object
 */
final class ServerVariableValue extends AbstractData
{
    /**
     * @param array<string> $enum
     */
    public function __construct(
        public readonly array $enum,
        #[Required()]
        public readonly string $default,
        public readonly string $description,
    ) {}
}
