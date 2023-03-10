<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\Video;

use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;
use CCT\SDK\Infrastructure\ValueObject\Uri;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class Video extends AbstractMulti
{
    public function __construct(public readonly Uri $videoUrl, public readonly VideoId $uuid)
    {
    }
}
