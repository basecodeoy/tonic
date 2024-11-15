<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Tonic\Data\Errors;

use BaseCodeOy\Tonic\Data\AbstractData;

/**
 * @see https://jsonapi.org/format/#error-objects
 */
final class ErrorObjectData extends AbstractData
{
    public function __construct(
        public readonly string $id,
        public readonly ?LinksData $links,
        public readonly string $status,
        public readonly string $code,
        public readonly string $title,
        public readonly string $detail,
        public readonly ?SourceData $source,
        public readonly ?array $meta,
    ) {}
}
