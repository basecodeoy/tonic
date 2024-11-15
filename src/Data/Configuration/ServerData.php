<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Tonic\Data\Configuration;

use BaseCodeOy\Tonic\Data\AbstractData;

final class ServerData extends AbstractData
{
    public function __construct(
        public readonly string $name,
        public readonly string $path,
        public readonly string $route,
        public readonly string $version,
        public readonly array $middleware,
        public readonly ?array $methods,
        public readonly array $content_descriptors,
        public readonly array $schemas,
    ) {}
}
