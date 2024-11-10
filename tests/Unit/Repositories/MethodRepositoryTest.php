<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

use BaseCodeOy\Tonic\Contracts\MethodInterface;
use BaseCodeOy\Tonic\Exceptions\MethodNotFoundException;
use BaseCodeOy\Tonic\Repositories\MethodRepository;
use Tests\Support\Fakes\Methods\Subtract;
use Tests\Support\Fakes\Methods\SubtractWithBinding;

it('registers and retrieves a method', function (): void {
    $methodRepository = new MethodRepository();
    $methodRepository->register(new Subtract());

    expect($methodRepository->get('app.subtract'))->toBeInstanceOf(Subtract::class);
});

it('registers a method using a class string', function (): void {
    $methodRepository = new MethodRepository();
    $methodRepository->register(Subtract::class);

    expect($methodRepository->get('app.subtract'))->toBeInstanceOf(MethodInterface::class);
});

it('throws an exception when a method is not found', function (): void {
    $methodRepository = new MethodRepository();

    $methodRepository->get('nonExistentMethod');
})->throws(MethodNotFoundException::class);

it('throws an exception when registering a duplicate method', function (): void {
    $methodRepository = new MethodRepository();
    $methodRepository->register(Subtract::class);
    $methodRepository->register(Subtract::class);
})->throws(RuntimeException::class);

it('retrieves all registered methods', function (): void {
    $methodRepository = new MethodRepository();
    $methodRepository->register(Subtract::class);
    $methodRepository->register(SubtractWithBinding::class);

    $methods = $methodRepository->all();

    expect($methods)->toHaveCount(2);
    expect($methods)->toHaveKey('app.subtract');
    expect($methods)->toHaveKey('app.subtract_with_binding');
});
