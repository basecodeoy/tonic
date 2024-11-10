<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\Contracts;

/**
 * @method static array  getFields()
 * @method static array  getFilters()
 * @method static array  getRelationships()
 * @method static array  getSorts()
 * @method static string getModel()
 */
interface ResourceInterface
{
    /**
     * Get the type of the resource.
     */
    public function getType(): string;

    /**
     * Get the primary identifier for the resource.
     */
    public function getId(): string;

    /**
     * Get all the loaded attributes for the resource.
     */
    public function getAttributes(): array;

    /**
     * Get all the loaded relations for the resource.
     */
    public function getRelations(): array;

    /**
     * Return the resource as an array.
     */
    public function toArray(): array;
}
