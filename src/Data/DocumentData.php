<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic\Data;

use Spatie\LaravelData\Data;

/**
 * This data object is used to represent the response data of a JSON-RPC
 * document response similar to JSON:API documents in the JSON:API
 * specification (https://jsonapi.org/format/#document-top-level).
 */
final class DocumentData extends AbstractData
{
    public function __construct(
        public readonly array $data,
        public readonly ?array $errors = null,
        public readonly ?array $meta = null,
    ) {}
}