<?php

declare(strict_types=1);

namespace CCT\SDK\Analytics\Response;

use CCT\SDK\Customer\Data\AgencyId;
use CCT\SDK\Customer\Data\CustomerId;
use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class Customer extends AbstractMulti
{
    public function __construct(
        public readonly CustomerId $customerId,
        public readonly AgencyId $agencyId
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->customerId->toString(),
            'agency_id' => $this->agencyId->toString(),
        ];
    }

    public static function fromArray(array $data): static
    {
        Assertion::allKeysExists($data, ['id', 'agency_id'], self::errorPropertyPath());

        return new self(
            CustomerId::fromString($data['id']),
            AgencyId::fromString($data['agency_id'])
        );
    }
}
