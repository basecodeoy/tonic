<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\Data;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

final class RequestObjectData extends AbstractData
{
    public function __construct(
        public readonly string $jsonrpc,
        public readonly mixed $id,
        public readonly string $method,
        public readonly ?array $params,
    ) {}

    public static function asRequest(string $method, ?array $params = null, mixed $id = null): self
    {
        return self::from([
            'jsonrpc' => '2.0',
            'id' => $id ?? Str::ulid(),
            'method' => $method,
            'params' => $params,
        ]);
    }

    public static function asNotification(string $method, ?array $params = null): self
    {
        return self::from([
            'jsonrpc' => '2.0',
            'id' => null,
            'method' => $method,
            'params' => $params,
        ]);
    }

    public function getParam(string $key, mixed $default = null): mixed
    {
        if ($this->params === null) {
            return $default;
        }

        return Arr::get($this->params, $key, $default);
    }

    public function getParams(): ?array
    {
        return $this->params;
    }

    public function isNotification(): bool
    {
        return $this->id === null;
    }
}
