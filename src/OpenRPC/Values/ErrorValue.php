<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
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
