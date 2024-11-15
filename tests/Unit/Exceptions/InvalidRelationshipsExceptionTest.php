<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use BaseCodeOy\Tonic\Exceptions\AbstractRequestException;
use BaseCodeOy\Tonic\Exceptions\InvalidRelationshipsException;

it('creates an invalid relationships exception', function (): void {
    $requestException = InvalidRelationshipsException::create(['relationship1'], ['relationship2', 'relationship3']);

    expect($requestException)->toBeInstanceOf(AbstractRequestException::class);
    expect($requestException->toArray())->toMatchSnapshot();
    expect($requestException->getErrorCode())->toBe(-32_602);
    expect($requestException->getErrorMessage())->toBe('Invalid params');
});
