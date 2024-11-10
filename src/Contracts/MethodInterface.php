<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\Contracts;

use BaseCodeOy\Tonic\Data\RequestObjectData;
use BaseCodeOy\Tonic\OpenRPC\Values\ContentDescriptorValue;

interface MethodInterface
{
    public function getName(): string;

    public function getSummary(): string;

    public function getParams(): array;

    public function getResult(): ?ContentDescriptorValue;

    public function getErrors(): array;

    public function setRequest(RequestObjectData $requestObject): void;
}
