<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\Data;

final class ResourceObjectData extends AbstractData
{
    public function __construct(
        public readonly string $type,
        public readonly string $id,
        public readonly array $attributes,
        public readonly ?array $relationships,
    ) {}
}
