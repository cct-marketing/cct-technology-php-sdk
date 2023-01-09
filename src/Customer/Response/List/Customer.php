<?php

declare(strict_types=1);

namespace CCT\SDK\Customer\Response\List;

use CCT\SDK\Customer\Data\CustomerId;
use CCT\SDK\Customer\Data\Name;
use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class Customer extends AbstractMulti
{
    public function __construct(public readonly CustomerId $id, public readonly Name $name, public readonly Name $tradingName)
    {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->toString(),
            'name' => $this->name->toString(),
            'trading_name' => $this->tradingName->toString(),
        ];
    }

    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'id', self::errorPropertyPath());
        Assertion::keyExists($data, 'name', self::errorPropertyPath());
        Assertion::keyExists($data, 'trading_name', self::errorPropertyPath());

        return new self(
            CustomerId::fromString($data['id']),
            Name::fromString($data['name']),
            Name::fromString($data['trading_name'] ?? '')
        );
    }
}
