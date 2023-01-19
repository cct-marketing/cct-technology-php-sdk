<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Options;

use CCT\SDK\Infrastucture\ValueObject\AbstractEnabled;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class NewPrice extends AbstractEnabled
{
}
