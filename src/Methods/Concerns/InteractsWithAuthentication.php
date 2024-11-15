<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Tonic\Methods\Concerns;

use Illuminate\Contracts\Auth\Authenticatable;

trait InteractsWithAuthentication
{
    protected function getCurrentUser(): Authenticatable
    {
        abort_unless(auth()->check(), 401, 'Unauthorized');

        /** @var Authenticatable */
        return auth()->user();
    }
}
