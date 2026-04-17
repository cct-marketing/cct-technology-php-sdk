<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Metadata\Branding;

use CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject;
use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class BrandingItem extends AbstractMulti
{
    public function __construct(
        #[CastToSingleValueObject(BrandingKey::class)]
        public readonly BrandingKey $key,
        public readonly string $value,
    ) {
    }
}
