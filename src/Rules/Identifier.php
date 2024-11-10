<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\Rules;

use Illuminate\Contracts\Validation\ValidationRule;

final class Identifier implements ValidationRule
{
    #[\Override()]
    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        if ($value === null) {
            return;
        }

        if (\is_numeric($value)) {
            return;
        }

        if (\is_string($value)) {
            return;
        }

        $fail('The :attribute must be an integer, string or null.');
    }
}
