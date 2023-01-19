<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Targeting\LocationTargeting;

use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class Coordinate extends AbstractMulti
{
    public function __construct(public readonly float $latitude, public readonly float $longitude)
    {
        $this->guard($latitude, $longitude);
    }

    private function guard(float $latitude, float $longitude)
    {
        Assertion::between($latitude, -90, 90, self::errorPropertyPath());
        Assertion::between($longitude, -180, 180, self::errorPropertyPath());
    }
}
