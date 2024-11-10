<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

use BaseCodeOy\Tonic\Exceptions\AbstractRequestException;
use BaseCodeOy\Tonic\Exceptions\InternalErrorException;

it('creates an internal error exception', function (): void {
    $exception = new Exception('Test error', 500);
    $requestException = InternalErrorException::create($exception);

    expect($requestException)->toBeInstanceOf(AbstractRequestException::class);
    expect($requestException->toArray())->toMatchSnapshot();
    expect($requestException->getErrorCode())->toBe(-32_603);
    expect($requestException->getErrorMessage())->toBe('Internal error');
    expect($requestException->getErrorData())->toMatchArray([
        [
            'status' => '500',
            'title' => 'Internal error',
            'detail' => 'Test error',
        ],
    ]);
});
