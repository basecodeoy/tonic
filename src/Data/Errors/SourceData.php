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
final class SourceData extends AbstractData
{
    public function __construct(
        public readonly ?string $pointer,
        public readonly ?string $parameter,
        public readonly ?string $header,
    ) {}
}
