<?php

declare(strict_types=1);

namespace CCT\SDK\Customer\Response\List;

use CCT\SDK\Customer\Data\AgencyId;
use CCT\SDK\Customer\Data\Name;
use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class Agency extends AbstractMulti
{
    public function __construct(public readonly AgencyId $id, public readonly Name $name, public readonly Name $tradingName, public readonly Customers $customers)
    {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->toString(),
            'name' => $this->name->toString(),
            'trading_name' => $this->tradingName->toString(),
            'customers' => $this->customers->toArray(),
        ];
    }

    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'id', self::errorPropertyPath());
        Assertion::keyExists($data, 'name', self::errorPropertyPath());
        Assertion::keyExists($data, 'trading_name', self::errorPropertyPath());
        Assertion::keyExists($data, 'customers', self::errorPropertyPath());

        return new self(
            AgencyId::fromString($data['id']),
            Name::fromString($data['name']),
            Name::fromString($data['trading_name'] ?? ''),
            Customers::fromArray($data['customers'])
        );
    }
}
