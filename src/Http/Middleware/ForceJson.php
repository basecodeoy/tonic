<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Tonic\Http\Middleware;

use Illuminate\Http\Request;

final class ForceJson
{
    public function handle(Request $request, \Closure $next): mixed
    {
        if ($request->is('rpc') || $request->is('rpc/*')) {
            $request->headers->set('Content-Type', 'application/json');
            $request->headers->set('Accept', 'application/json');
        }

        return $next($request);
    }
}
