<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
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
