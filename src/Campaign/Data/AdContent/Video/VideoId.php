<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\Video;

use CCT\SDK\Infrastucture\ValueObject\AbstractUuid;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class VideoId extends AbstractUuid
{
}
