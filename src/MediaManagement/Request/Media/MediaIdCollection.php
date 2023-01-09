<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\Request\Media;

use CCT\SDK\Infrastucture\ValueObject\AbstractCollection;

final class MediaIdCollection extends AbstractCollection
{
    protected static function itemClassName(): string
    {
        return MediaId::class;
    }
}
