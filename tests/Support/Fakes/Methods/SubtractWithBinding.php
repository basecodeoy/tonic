<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace Tests\Support\Fakes\Methods;

use BaseCodeOy\Tonic\Methods\AbstractMethod;

final class SubtractWithBinding extends AbstractMethod
{
    public function handle(string $minuend, string $subtrahend): int
    {
        return $minuend - $subtrahend;
    }
}
