<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent;

use CCT\SDK\Infrastucture\ValueObject\AbstractBool;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class UserSelected extends AbstractBool
{
}
