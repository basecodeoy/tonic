<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Tonic\Contracts;

use BaseCodeOy\Tonic\Repositories\MethodRepository;

interface ServerInterface
{
    public function getName(): string;

    public function getRoutePath(): string;

    public function getRouteName(): string;

    public function getVersion(): string;

    public function getMiddleware(): array;

    public function getMethodRepository(): MethodRepository;

    public function getContentDescriptors(): array;

    public function getSchemas(): array;
}
