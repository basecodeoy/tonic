<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Tonic\Exceptions\Actions;

use BaseCodeOy\Tonic\Exceptions\ExceptionMapper;
use Illuminate\Configuration\Exceptions;
use Illuminate\Http\Request;

final readonly class RendersThrowable
{
    public static function execute(Exceptions $exceptions): void
    {
        $exceptions->renderable(
            function (\Throwable $exception, Request $request) {
                if (!$request->wantsJson()) {
                    return;
                }

                $exception = ExceptionMapper::execute($exception);

                return response()->json(
                    \array_filter([
                        'jsonrpc' => '2.0',
                        'id' => $request->input('id'),
                        'error' => $exception->toArray(),
                    ]),
                    $exception->getStatusCode(),
                    $exception->getHeaders(),
                );
            },
        );
    }
}
