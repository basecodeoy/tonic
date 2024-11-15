<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Support;

use Illuminate\Support\Facades\URL;
use function Pest\Laravel\call;

final class MethodCaller
{
    public static function call(string $path, int $statusCode = 200): void
    {
        $request = \file_get_contents(\realpath(__DIR__.\sprintf('/Fixtures/Requests/%s.json', $path)));
        $response = \file_get_contents(\realpath(__DIR__.\sprintf('/Fixtures/Responses/%s.json', $path)));

        call('POST', URL::to('/rpc'), [], [], [], [], $request)
            ->assertStatus($statusCode)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson(\json_decode($response, true, 512, \JSON_THROW_ON_ERROR));
    }
}
