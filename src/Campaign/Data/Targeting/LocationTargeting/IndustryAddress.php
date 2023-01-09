<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Targeting\LocationTargeting;

use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class IndustryAddress extends AbstractMulti
{
    public function __construct(
        public readonly Address $address,
        public readonly LocationType $type,
        public readonly ?Coordinate $coordinate
    ) {
    }

    public function toArray(): array
    {
        return [
            'address' => $this->address->toArray(),
            'type' => $this->type->value,
            'coordinate' => $this->coordinate?->toArray(),
        ];
    }

    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'address', self::errorPropertyPath());

        return new self(
            Address::fromArray($data['address']),
            isset($data['type']) ? LocationType::from($data['type']) : LocationType::DEFAULT,
            isset($data['coordinate']) ? Coordinate::fromArray($data['coordinate']) : null
        );
    }
}
