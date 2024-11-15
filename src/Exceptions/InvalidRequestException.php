<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
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
