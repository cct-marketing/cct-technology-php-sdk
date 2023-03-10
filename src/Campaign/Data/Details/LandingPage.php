<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Details;

use CCT\SDK\Infrastructure\ValueObject\AbstractUrl;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class LandingPage extends AbstractUrl
{
}
