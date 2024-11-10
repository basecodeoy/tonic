<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

use BaseCodeOy\Tonic\Exceptions\AbstractRequestException;
use BaseCodeOy\Tonic\Exceptions\MethodNotFoundException;

it('creates a method not found exception', function (): void {
    $requestException = MethodNotFoundException::create();

    expect($requestException)->toBeInstanceOf(AbstractRequestException::class);
    expect($requestException->toArray())->toMatchSnapshot();
    expect($requestException->getErrorCode())->toBe(-32_601);
    expect($requestException->getErrorMessage())->toBe('Method not found');
});