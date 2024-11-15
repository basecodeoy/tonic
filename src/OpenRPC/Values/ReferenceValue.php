<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Tonic\OpenRPC\Values;

use BaseCodeOy\Tonic\Data\AbstractData;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Attributes\Validation\Required;

/**
 * @see https://spec.open-rpc.org/#reference-object
 */
final class ReferenceValue extends AbstractData
{
    public function __construct(
        #[MapOutputName('$ref')]
        #[Required()]
        public readonly string $ref,
    ) {}
}
