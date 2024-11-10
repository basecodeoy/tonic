<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace Tests\Support\Fakes\Methods;

use BaseCodeOy\Tonic\Data\RequestObjectData;
use BaseCodeOy\Tonic\Methods\AbstractMethod;

final class Subtract extends AbstractMethod
{
    public function handle(RequestObjectData $requestObject): int
    {
        return $requestObject->getParam('data.0') - $requestObject->getParam('data.1');
    }
}
