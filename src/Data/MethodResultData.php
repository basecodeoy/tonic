<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\Data;

final class MethodResultData extends AbstractData
{
    public function __construct(
        public readonly string $jsonrpc,
        public readonly mixed $id,
        public readonly mixed $result,
    ) {}

    #[\Override()]
    public function toArray(): array
    {
        return [
            'jsonrpc' => $this->jsonrpc,
            'id' => $this->id,
            'result' => $this->result,
        ];
    }
}
