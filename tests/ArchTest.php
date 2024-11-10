<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

use BaseCodeOy\Tonic\Servers\ConfigurationServer;

arch('globals')
    ->expect(['dd', 'dump'])
    ->not->toBeUsed();

// arch('BaseCodeOy\Tonic\Clients')
//     ->expect('BaseCodeOy\Tonic\Clients')
//     ->toUseStrictTypes()
//     ->toBeFinal();

// arch('BaseCodeOy\Tonic\Contracts')
//     ->expect('BaseCodeOy\Tonic\Contracts')
//     ->toUseStrictTypes()
//     ->toBeInterfaces();

// arch('BaseCodeOy\Tonic\Data')
//     ->expect('BaseCodeOy\Tonic\Data')
//     ->toUseStrictTypes()
//     ->toBeFinal()
//     ->ignoring([
//         BaseCodeOy\Tonic\Data\AbstractContentDescriptorData::class,
//         BaseCodeOy\Tonic\Data\AbstractData::class,
//     ])
//     ->toHaveSuffix('Data')
//     ->toExtend(Spatie\LaravelData\Data::class);

// arch('BaseCodeOy\Tonic\Exceptions')
//     ->expect('BaseCodeOy\Tonic\Exceptions')
//     ->toUseStrictTypes()
//     ->toBeFinal()
//     ->ignoring([
//         BaseCodeOy\Tonic\Exceptions\AbstractRequestException::class,
//         BaseCodeOy\Tonic\Exceptions\Concerns\RendersThrowable::class,
//     ]);

// arch('BaseCodeOy\Tonic\Facades')
//     ->expect('BaseCodeOy\Tonic\Facades')
//     ->toUseStrictTypes()
//     ->toBeFinal();

// arch('BaseCodeOy\Tonic\Http')
//     ->expect('BaseCodeOy\Tonic\Http')
//     ->toUseStrictTypes()
//     ->toBeFinal();

// arch('BaseCodeOy\Tonic\Jobs')
//     ->expect('BaseCodeOy\Tonic\Jobs')
//     ->toUseStrictTypes()
//     ->toBeFinal()
//     ->toBeReadonly();

// arch('BaseCodeOy\Tonic\Methods')
//     ->expect('BaseCodeOy\Tonic\Methods')
//     ->toUseStrictTypes();

// arch('BaseCodeOy\Tonic\Mixins')
//     ->expect('BaseCodeOy\Tonic\Mixins')
//     ->toUseStrictTypes()
//     ->toBeFinal()
//     ->toBeReadonly();

// arch('BaseCodeOy\Tonic\Normalizers')
//     ->expect('BaseCodeOy\Tonic\Normalizers')
//     ->toUseStrictTypes()
//     ->toBeFinal()
//     ->toBeReadonly()
//     ->toHaveSuffix('Normalizer');

// arch('BaseCodeOy\Tonic\QueryBuilders')
//     ->expect('BaseCodeOy\Tonic\QueryBuilders')
//     ->toUseStrictTypes()
//     ->toBeFinal()
//     ->ignoring('BaseCodeOy\Tonic\QueryBuilders\Concerns');

// arch('BaseCodeOy\Tonic\Repositories')
//     ->expect('BaseCodeOy\Tonic\Repositories')
//     ->toUseStrictTypes()
//     ->toBeFinal();

// arch('BaseCodeOy\Tonic\Requests')
//     ->expect('BaseCodeOy\Tonic\Requests')
//     ->toUseStrictTypes()
//     ->toBeFinal();

// arch('BaseCodeOy\Tonic\Rules')
//     ->expect('BaseCodeOy\Tonic\Rules')
//     ->toUseStrictTypes()
//     ->toBeFinal();

// arch('BaseCodeOy\Tonic\Servers')
//     ->expect('BaseCodeOy\Tonic\Servers')
//     ->toUseStrictTypes()
//     ->toBeAbstract()
//     ->ignoring(ConfigurationServer::class);

// arch('BaseCodeOy\Tonic\Transformers')
//     ->expect('BaseCodeOy\Tonic\Transformers')
//     ->toUseStrictTypes()
//     ->toBeFinal()
//     ->toHaveSuffix('Transformer');
