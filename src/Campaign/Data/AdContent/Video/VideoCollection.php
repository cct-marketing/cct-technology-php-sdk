<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\Video;

use CCT\SDK\Infrastucture\ValueObject\AbstractCollection;

final class VideoCollection extends AbstractCollection
{
    protected static function itemClassName(): string
    {
        return Video::class;
    }
}
