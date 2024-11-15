<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
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
