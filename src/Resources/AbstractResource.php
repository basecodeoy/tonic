<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\Resources;

use BaseCodeOy\Tonic\Contracts\ResourceInterface;

abstract class AbstractResource implements ResourceInterface
{
    public static function getFields(): array
    {
        return [];
    }

    public static function getFilters(): array
    {
        return [];
    }

    public static function getRelationships(): array
    {
        return [];
    }

    public static function getSorts(): array
    {
        return [];
    }

    #[\Override()]
    public function toArray(): array
    {
        return [
            'type' => $this->getType(),
            'id' => $this->getId(),
            'attributes' => $this->getAttributes(),
        ];
    }
}
