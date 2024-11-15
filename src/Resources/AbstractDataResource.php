<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Tonic\Resources;

use Illuminate\Support\Str;
use Spatie\LaravelData\Data;

abstract class AbstractDataResource extends AbstractResource
{
    public function __construct(
        private readonly Data $model,
    ) {}

    #[\Override()]
    public function getType(): string
    {
        return Str::singular(Str::beforeLast(class_basename($this->model), 'Data'));
    }

    #[\Override()]
    public function getId(): string
    {
        return (string) data_get($this->model, 'id');
    }

    #[\Override()]
    public function getAttributes(): array
    {
        return $this->model->toArray();
    }

    #[\Override()]
    public function getRelations(): array
    {
        return [];
    }
}
