<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\Exceptions;

use Illuminate\Validation\Validator;

final class InvalidRequestException extends AbstractRequestException
{
    public static function create(?array $data = null): self
    {
        return self::new(-32_600, 'Invalid Request', $data);
    }

    public static function createFromValidator(Validator $validator): self
    {
        $normalized = [];

        foreach ($validator->errors()->messages() as $attribute => $errors) {
            foreach ($errors as $error) {
                $normalized[] = [
                    'status' => '422',
                    'source' => ['pointer' => '/'.$attribute],
                    'title' => 'Invalid member',
                    'detail' => $error,
                ];
            }
        }

        return self::create($normalized);
    }
}
