<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data;

use CCT\SDK\Infrastructure\ValueObject\AbstractUuid;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class CampaignId extends AbstractUuid
{
}
