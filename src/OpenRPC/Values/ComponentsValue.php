<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Tonic\OpenRPC\Values;

use BaseCodeOy\Tonic\Data\AbstractData;

/**
 * @see https://spec.open-rpc.org/#components-object
 */
final class ComponentsValue extends AbstractData
{
    /**
     * @param null|array<string, ContentDescriptorValue> $contentDescriptors
     * @param null|array<string, SchemaValue>            $schemas
     * @param null|array<string, ExampleValue>           $examples
     * @param null|array<string, LinkValue>              $links
     * @param null|array<string, ErrorValue>             $errors
     * @param null|array<string, ExamplePairingValue>    $examplePairingObjects
     * @param null|array<string, TagValue>               $tags
     */
    public function __construct(
        public readonly ?array $contentDescriptors,
        public readonly ?array $schemas,
        public readonly ?array $examples,
        public readonly ?array $links,
        public readonly ?array $errors,
        public readonly ?array $examplePairingObjects,
        public readonly ?array $tags,
    ) {}
}
