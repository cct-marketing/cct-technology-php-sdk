<?php

declare(strict_types=1);

namespace CCT\SDK\Customer\Response\List;

use CCT\SDK\Customer\Data\CustomerId;
use CCT\SDK\Customer\Data\Name;
use CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject;
use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;

final class Customer extends AbstractMulti
{
    public function __construct(
        #[CastToSingleValueObject(CustomerId::class)]
        public readonly CustomerId $id,
        #[CastToSingleValueObject(Name::class)]
        public readonly Name $name,
        #[CastToSingleValueObject(Name::class)]
        public readonly ?Name $tradingName
    ) {
    }
}
