<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\Methods;

use BaseCodeOy\Tonic\Contracts\MethodInterface;
use BaseCodeOy\Tonic\Data\RequestObjectData;
use BaseCodeOy\Tonic\OpenRPC\Values\ContentDescriptorValue;
use Illuminate\Support\Str;

abstract class AbstractMethod implements MethodInterface
{
    use Concerns\InteractsWithAuthentication;
    use Concerns\InteractsWithQueryBuilder;
    use Concerns\InteractsWithTransformer;

    protected RequestObjectData $requestObject;

    #[\Override()]
    public function getName(): string
    {
        return 'app.'.Str::snake(class_basename(static::class));
    }

    #[\Override()]
    public function getSummary(): string
    {
        return $this->getName();
    }

    #[\Override()]
    public function getParams(): array
    {
        return [];
    }

    #[\Override()]
    public function getResult(): ?ContentDescriptorValue
    {
        return null;
    }

    #[\Override()]
    public function getErrors(): array
    {
        return [];
    }

    #[\Override()]
    public function setRequest(RequestObjectData $requestObject): void
    {
        $this->requestObject = $requestObject;
    }
}
