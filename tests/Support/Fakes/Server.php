<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace Tests\Support\Fakes;

use BaseCodeOy\Tonic\Servers\AbstractServer;
use Tests\Support\Fakes\Methods\GetData;
use Tests\Support\Fakes\Methods\NotifyHello;
use Tests\Support\Fakes\Methods\NotifySum;
use Tests\Support\Fakes\Methods\Subtract;
use Tests\Support\Fakes\Methods\SubtractWithBinding;
use Tests\Support\Fakes\Methods\Sum;

final class Server extends AbstractServer
{
    #[\Override()]
    public function methods(): array
    {
        return [
            GetData::class,
            NotifyHello::class,
            NotifySum::class,
            Subtract::class,
            SubtractWithBinding::class,
            Sum::class,
        ];
    }
}
