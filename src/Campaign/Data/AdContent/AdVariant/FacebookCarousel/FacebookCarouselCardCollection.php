<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel;

use CCT\SDK\Campaign\Data\AdContent\Image\ImageCollection;
use CCT\SDK\Infrastructure\ValueObject\AbstractCollection;

final class FacebookCarouselCardCollection extends AbstractCollection
{
    public function withImages(ImageCollection $images): self
    {
        $items = array_map(static function (int $index, FacebookCarouselCard $facebookCarouselCard) use ($images) {
            return $facebookCarouselCard->withImage($images->getAt($index));
        }, array_keys($this->items), $this->items);

        return self::fromItems(...$items);
    }

    public static function itemClassName(): string
    {
        return FacebookCarouselCard::class;
    }
}
