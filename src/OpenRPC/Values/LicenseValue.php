<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Tonic\OpenRPC\Values;

use BaseCodeOy\Tonic\Data\AbstractData;

/**
 * @see https://spec.open-rpc.org/#license-object
 */
final class LicenseValue extends AbstractData
{
    public function __construct(
        public readonly ?string $name,
        public readonly ?string $url,
    ) {}
}
