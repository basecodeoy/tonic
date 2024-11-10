<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\Data\Requests;

use BaseCodeOy\Tonic\Data\AbstractData;

final class FilterData extends AbstractData
{
    public function __construct(
        public readonly string $attribute,
        public readonly string $value,
        public readonly string $operator,
        public readonly ?string $boolean,
    ) {}
}
