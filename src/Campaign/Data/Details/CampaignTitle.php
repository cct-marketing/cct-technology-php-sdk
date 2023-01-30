<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Details;

use Assert\Assertion;
use CCT\SDK\Infrastructure\ValueObject\AbstractString;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class CampaignTitle extends AbstractString
{
    protected function guard(string $value): void
    {
        Assertion::maxLength($value, 120, null, self::errorPropertyPath());
    }
}
