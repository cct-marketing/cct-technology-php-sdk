<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\Image;

use CCT\SDK\Infrastructure\ValueObject\AbstractUuid;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class ImageId extends AbstractUuid
{
}
