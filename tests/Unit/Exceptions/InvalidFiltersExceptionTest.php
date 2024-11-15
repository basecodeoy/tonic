<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use BaseCodeOy\Tonic\Exceptions\AbstractRequestException;
use BaseCodeOy\Tonic\Exceptions\InvalidFiltersException;

it('creates an invalid filters exception', function (): void {
    $requestException = InvalidFiltersException::create(['filter1'], ['filter2', 'filter3']);

    expect($requestException)->toBeInstanceOf(AbstractRequestException::class);
    expect($requestException->toArray())->toMatchSnapshot();
    expect($requestException->getErrorCode())->toBe(-32_602);
    expect($requestException->getErrorMessage())->toBe('Invalid params');
});
