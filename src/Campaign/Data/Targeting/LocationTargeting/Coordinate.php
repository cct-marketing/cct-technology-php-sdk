<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Targeting\LocationTargeting;

use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class Coordinate extends AbstractMulti
{
    public function __construct(public readonly float $latitude, public readonly float $longitude)
    {
        $this->guard($latitude, $longitude);
    }

    public function toArray(): array
    {
        return [
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }

    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'latitude', self::errorPropertyPath());
        Assertion::keyExists($data, 'longitude', self::errorPropertyPath());

        Assertion::numeric($data['latitude'], self::errorPropertyPath());
        Assertion::numeric($data['longitude'], self::errorPropertyPath());

        return new self(
            (float) $data['latitude'],
            (float) $data['longitude']
        );
    }

    private function guard(float $latitude, float $longitude)
    {
        Assertion::between($latitude, -90, 90, self::errorPropertyPath());
        Assertion::between($longitude, -180, 180, self::errorPropertyPath());
    }
}
