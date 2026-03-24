<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Targeting\PropertyInformation;

use CCT\SDK\Infrastructure\ValueObject\AbstractInteger;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class PropertyTotalPrice extends AbstractInteger
{
    protected function guard(int $value): void
    {
    }
}
