<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
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
