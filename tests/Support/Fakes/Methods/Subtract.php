<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
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
