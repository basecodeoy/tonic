<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
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
