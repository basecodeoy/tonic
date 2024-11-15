<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Tonic\OpenRPC\Values;

use BaseCodeOy\Tonic\Data\AbstractData;
use Spatie\LaravelData\Attributes\Validation\Required;

/**
 * @see https://spec.open-rpc.org/#info-object
 */
final class InfoValue extends AbstractData
{
    public function __construct(
        #[Required()]
        public readonly string $title,
        public readonly ?string $description,
        public readonly ?string $termsOfService,
        public readonly ?ContactValue $contact,
        public readonly ?LicenseValue $license,
        #[Required()]
        public readonly string $version,
    ) {}
}
