<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignFlow\Data;

use CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject;
use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;

final class Settings extends AbstractMulti
{
    public function __construct(
        #[CastToSingleValueObject(Currency::class)]
        public readonly Currency $currency,
        #[CastToSingleValueObject(Vat::class)]
        public readonly Vat $vat,
        public readonly ExcludeVat $excludeVat
    ) {
    }
}
