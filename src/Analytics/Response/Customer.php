<?php

declare(strict_types=1);

namespace CCT\SDK\Analytics\Response;

use CCT\SDK\Customer\Data\AgencyId;
use CCT\SDK\Customer\Data\CustomerId;
use CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject;
use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class Customer extends AbstractMulti
{
    public function __construct(
        #[CastToSingleValueObject(CustomerId::class)]
        public readonly CustomerId $id,
        #[CastToSingleValueObject(AgencyId::class)]
        public readonly AgencyId $agencyId
    ) {
    }
}
