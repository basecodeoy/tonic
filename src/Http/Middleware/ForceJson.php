<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
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
