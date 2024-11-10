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
 * @see https://spec.open-rpc.org/#error-object
 */
final class ErrorValue extends AbstractData
{
    public function __construct(
        #[Required()]
        public readonly int $code,
        #[Required()]
        public readonly string $message,
        public readonly mixed $data,
    ) {}
}
