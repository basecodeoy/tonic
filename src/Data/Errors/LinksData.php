<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\Data\Errors;

use BaseCodeOy\Tonic\Data\AbstractData;

/**
 * @see https://jsonapi.org/format/#error-objects
 */
final class LinksData extends AbstractData
{
    public function __construct(
        public readonly ?string $about,
        public readonly ?string $type,
    ) {}
}
