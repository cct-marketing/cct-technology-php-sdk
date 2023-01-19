<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\Request\Media;

use CCT\SDK\Infrastucture\ValueObject\AbstractCollection;

final class MediaIdCollection extends AbstractCollection
{
    /**
     * @param MediaId[] $items
     */
    public function __construct(array $items)
    {
        parent::__construct($items);
    }

    public static function itemClassName(): string
    {
        return MediaId::class;
    }
}
