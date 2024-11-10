<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

use BaseCodeOy\Tonic\Rules\Identifier;
use Illuminate\Support\Facades\Validator;

it('validates correctly with an integer', function (): void {
    $validator = Validator::make(
        ['value' => 123],
        ['value' => [new Identifier()]],
    );

    expect($validator->passes())->toBeTrue();
});

it('validates correctly with a string', function (): void {
    $validator = Validator::make(
        ['value' => 'string'],
        ['value' => [new Identifier()]],
    );

    expect($validator->passes())->toBeTrue();
});

it('validates correctly with null', function (): void {
    $validator = Validator::make(
        ['value' => null],
        ['value' => [new Identifier()]],
    );

    expect($validator->passes())->toBeTrue();
});

it('fails validation for an array', function (): void {
    $validator = Validator::make(
        ['value' => []],
        ['value' => [new Identifier()]],
    );

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('value'))->toBe('The value must be an integer, string or null.');
});

it('fails validation for an object', function (): void {
    $validator = Validator::make(
        ['value' => new stdClass()],
        ['value' => [new Identifier()]],
    );

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('value'))->toBe('The value must be an integer, string or null.');
});

it('fails validation for a boolean', function (): void {
    $validator = Validator::make(
        ['value' => true],
        ['value' => [new Identifier()]],
    );

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('value'))->toBe('The value must be an integer, string or null.');
});
