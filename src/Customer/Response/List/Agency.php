<?php

declare(strict_types=1);

namespace CCT\SDK\Customer\Response\List;

use CCT\SDK\Customer\Data\AgencyId;
use CCT\SDK\Customer\Data\Name;
use CCT\SDK\Infrastucture\Serialization\Caster\CastToCollectionObject;
use CCT\SDK\Infrastucture\Serialization\Caster\CastToSingleValueObject;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class Agency extends AbstractMulti
{
    public function __construct(
        #[CastToSingleValueObject(AgencyId::class)]
        public readonly AgencyId $id,
        #[CastToSingleValueObject(Name::class)]
        public readonly Name $name,
        #[CastToSingleValueObject(Name::class)]
        public readonly ?Name $tradingName,
        #[CastToCollectionObject(Customers::class)]
        public readonly Customers $customers
    ) {
    }
}
