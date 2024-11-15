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
 * @see https://spec.open-rpc.org/#openrpc-object
 */
final class DocumentValue extends AbstractData
{
    public function __construct(
        #[Required()]
        public readonly string $openrpc,
        #[Required()]
        public readonly InfoValue $info,
        #[DataCollectionOf(ServerValue::class)]
        public readonly ?DataCollection $servers,
        #[DataCollectionOf(MethodValue::class)]
        #[Required()]
        public readonly DataCollection $methods,
        public readonly ?ComponentsValue $components,
        public readonly ?ExternalDocumentationValue $externalDocs,
    ) {}
}
