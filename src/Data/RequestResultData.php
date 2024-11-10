<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\Data;

final class RequestResultData extends AbstractData
{
    public function __construct(
        public readonly mixed $data,
        public readonly int $statusCode,
        public readonly array $headers = [],
    ) {}
}
