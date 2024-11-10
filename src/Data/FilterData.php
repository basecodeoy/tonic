<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\Data;

final class FilterData extends AbstractData
{
    public function __construct(
        public readonly string $attribute,
        public readonly string $condition,
        public readonly mixed $value,
    ) {}
}
