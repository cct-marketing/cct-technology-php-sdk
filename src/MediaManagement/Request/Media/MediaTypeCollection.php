<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\Request\Media;

use CCT\SDK\Infrastucture\ValueObject\AbstractCollection;
use CCT\SDK\MediaManagement\ViewModel\MediaType;

final class MediaTypeCollection extends AbstractCollection
{
    /**
     * @param MediaType[] $items
     */
    public function __construct(array $items)
    {
        parent::__construct($items);
    }

    public static function itemClassName(): string
    {
        return MediaType::class;
    }
}
