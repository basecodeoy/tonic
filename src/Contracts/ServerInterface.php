<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
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
