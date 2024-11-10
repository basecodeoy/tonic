<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\Methods;

use BaseCodeOy\Tonic\Data\DocumentData;
use BaseCodeOy\Tonic\OpenRPC\ContentDescriptors\CursorPaginatorContentDescriptor;
use BaseCodeOy\Tonic\OpenRPC\ContentDescriptors\FieldsContentDescriptor;
use BaseCodeOy\Tonic\OpenRPC\ContentDescriptors\FiltersContentDescriptor;
use BaseCodeOy\Tonic\OpenRPC\ContentDescriptors\RelationshipsContentDescriptor;
use BaseCodeOy\Tonic\OpenRPC\ContentDescriptors\SortsContentDescriptor;

abstract class AbstractListMethod extends AbstractMethod
{
    public function handle(): DocumentData
    {
        return $this->cursorPaginate(
            $this->query(
                $this->getResourceClass(),
            ),
        );
    }

    #[\Override()]
    public function getParams(): array
    {
        $className = $this->getResourceClass();

        return [
            CursorPaginatorContentDescriptor::create(),
            FieldsContentDescriptor::create($className::getFields()),
            FiltersContentDescriptor::create($className::getFilters()),
            RelationshipsContentDescriptor::create($className::getRelationships()),
            SortsContentDescriptor::create($className::getSorts()),
        ];
    }

    abstract protected function getResourceClass(): string;
}
