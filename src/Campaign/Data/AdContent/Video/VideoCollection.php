<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\Video;

use CCT\SDK\Infrastucture\ValueObject\AbstractCollection;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class VideoCollection extends AbstractCollection
{
    public static function itemClassName(): string
    {
        return Video::class;
    }
}
