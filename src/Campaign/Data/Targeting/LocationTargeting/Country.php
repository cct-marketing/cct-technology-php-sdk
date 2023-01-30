<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Targeting\LocationTargeting;

use CCT\SDK\Infrastructure\Assert\Assertion;
use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class Country extends AbstractMulti
{
    public function __construct(public readonly string $name, public readonly string $code)
    {
        $this->guard($code);
    }

    public function guard(string $code)
    {
        Assertion::maxLength($code, 2, self::errorPropertyPath());
        Assertion::minLength($code, 2, self::errorPropertyPath());
    }
}
