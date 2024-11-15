<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use BaseCodeOy\Tonic\Exceptions\InvalidFieldsException;
use BaseCodeOy\Tonic\Exceptions\InvalidFiltersException;
use BaseCodeOy\Tonic\Exceptions\InvalidRelationshipsException;
use BaseCodeOy\Tonic\Exceptions\InvalidSortsException;
use BaseCodeOy\Tonic\QueryBuilders\QueryBuilder;
use Tests\Support\Resources\UserResource;

it('applies fields to the query', function (): void {
    expect(
        QueryBuilder::for(
            resource: UserResource::class,
            requestFields: [
                'self' => ['name'],
                'posts' => ['name'],
            ],
            allowedFields: [
                'self' => ['name'],
                'posts' => ['name'],
            ],
            requestFilters: [],
            allowedFilters: [],
            requestRelationships: [],
            allowedRelationships: [],
            requestSorts: [],
            allowedSorts: [],
        )->toSql(),
    )->toContain('select "name"');
});

it('throws an exception for invalid fields', function (): void {
    QueryBuilder::for(
        resource: UserResource::class,
        requestFields: [
            'self' => ['invalid_field'],
        ],
        allowedFields: [
            'self' => ['name'],
        ],
        requestFilters: [],
        allowedFilters: [],
        requestRelationships: [],
        allowedRelationships: [],
        requestSorts: [],
        allowedSorts: [],
    );
})->throws(InvalidFieldsException::class);

it('applies filters to the query', function (): void {
    expect(
        QueryBuilder::for(
            resource: UserResource::class,
            requestFields: [],
            allowedFields: [],
            requestFilters: [
                'self' => [
                    [
                        'attribute' => 'name',
                        'operator' => 'equals',
                        'value' => 'John',
                    ],
                ],
            ],
            allowedFilters: [
                'self' => ['name'],
            ],
            requestRelationships: [],
            allowedRelationships: [],
            requestSorts: [],
            allowedSorts: [],
        )->toSql(),
    )->toContain('where "name" = ?');
});

it('throws an exception for invalid filters', function (): void {
    QueryBuilder::for(
        resource: UserResource::class,
        requestFields: [],
        allowedFields: [],
        requestFilters: [
            'self' => [
                [
                    'attribute' => 'invalid_filter',
                    'operator' => 'equals',
                    'value' => 'John',
                ],
            ],
        ],
        allowedFilters: [
            'self' => ['name'],
        ],
        requestRelationships: [],
        allowedRelationships: [],
        requestSorts: [],
        allowedSorts: [],
    );
})->throws(InvalidFiltersException::class);

it('applies relationships to the query', function (): void {
    expect(
        QueryBuilder::for(
            resource: UserResource::class,
            requestFields: [],
            allowedFields: [],
            requestFilters: [],
            allowedFilters: [],
            requestRelationships: [
                'self' => ['posts'],
            ],
            allowedRelationships: [
                'self' => ['posts', 'comments'],
            ],
            requestSorts: [],
            allowedSorts: [],
        )->toSql(),
    )->toContain('select *');
});

it('throws an exception for invalid relationships', function (): void {
    QueryBuilder::for(
        resource: UserResource::class,
        requestFields: [],
        allowedFields: [],
        requestFilters: [],
        allowedFilters: [],
        requestRelationships: [
            'self' => ['invalid_relationship'],
        ],
        allowedRelationships: [
            'self' => ['posts', 'comments'],
        ],
        requestSorts: [],
        allowedSorts: [],
    );
})->throws(InvalidRelationshipsException::class);

it('applies sorts to the query', function (): void {
    $queryBuilder = QueryBuilder::for(
        resource: UserResource::class,
        requestFields: [],
        allowedFields: [],
        requestFilters: [],
        allowedFilters: [],
        requestRelationships: [],
        allowedRelationships: [],
        requestSorts: [
            'self' => [
                [
                    'attribute' => 'name',
                    'direction' => 'asc',
                ],
            ],
        ],
        allowedSorts: [
            'self' => ['name', 'email'],
        ],
    );

    expect($queryBuilder->toSql())->toContain('order by "name" asc');
});

it('throws an exception for invalid sorts', function (): void {
    QueryBuilder::for(
        resource: UserResource::class,
        requestFields: [],
        allowedFields: [],
        requestFilters: [],
        allowedFilters: [],
        requestRelationships: [],
        allowedRelationships: [],
        requestSorts: [
            'self' => [
                [
                    'attribute' => 'invalid_sort',
                    'direction' => 'asc',
                ],
            ],
        ],
        allowedSorts: [
            'self' => ['name', 'email'],
        ],
    );
})->throws(InvalidSortsException::class);
