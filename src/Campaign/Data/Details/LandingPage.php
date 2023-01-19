<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Details;

use CCT\SDK\Infrastucture\ValueObject\AbstractUrl;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class LandingPage extends AbstractUrl
{
}
