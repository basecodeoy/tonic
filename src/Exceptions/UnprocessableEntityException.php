<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\Exceptions;

use Illuminate\Validation\ValidationException;

final class UnprocessableEntityException extends AbstractRequestException
{
    public static function create(?string $detail = null): self
    {
        return self::new(-32_000, 'Server error', [
            [
                'status' => '422',
                'title' => 'Unprocessable Entity',
                'detail' => $detail ?? 'The request was well-formed but was unable to be followed due to semantic errors.',
            ],
        ]);
    }

    public static function createFromValidationException(ValidationException $exception): self
    {
        $normalized = [];

        foreach ($exception->errors() as $attribute => $errors) {
            foreach ($errors as $error) {
                $normalized[] = [
                    'status' => '422',
                    'source' => ['pointer' => '/params/'.$attribute],
                    'title' => 'Invalid params',
                    'detail' => $error,
                ];
            }
        }

        return self::new(-32_000, 'Unprocessable Entity', $normalized);
    }

    #[\Override()]
    public function getStatusCode(): int
    {
        return 422;
    }
}
