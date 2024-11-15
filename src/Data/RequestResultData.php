<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
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
