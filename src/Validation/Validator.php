<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Tonic\Validation;

use Illuminate\Validation\ValidationException;

final class Validator
{
    public static function validate(array $data, array $rules): void
    {
        $validator = validator($data, $rules);

        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->all());
        }
    }
}
