<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Targeting\LocationTargeting;

use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class Location extends AbstractMulti
{
    public function __construct(
        public readonly string $address,
        public readonly Coordinate $coordinate,
        public readonly Radius $radius,
        public readonly LocationType $type
    ) {
    }

    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'address', self::errorPropertyPath());
        Assertion::keyExists($data, 'coordinate', self::errorPropertyPath());
        Assertion::keyExists($data, 'radius', self::errorPropertyPath());

        return new self(
            $data['address'],
            Coordinate::fromArray($data['coordinate']),
            Radius::fromArray($data['radius']),
            isset($data['type']) ? LocationType::from($data['type']) : LocationType::DEFAULT
        );
    }

    public function toArray(): array
    {
        return [
            'address' => $this->address,
            'coordinate' => $this->coordinate->toArray(),
            'radius' => $this->radius->toArray(),
            'type' => $this->type->value,
        ];
    }
}
