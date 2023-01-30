<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel;

use CCT\SDK\Campaign\Data\AdContent\Image\ImageCollection;
use CCT\SDK\Infrastructure\ValueObject\AbstractCollection;

final class FacebookCarouselVariants extends AbstractCollection
{
    public function withImages(ImageCollection $images): self
    {
        $items = array_map(static function (FacebookCarouselVariant $facebookCarouselVariant) use ($images) {
            return $facebookCarouselVariant->withImages($images);
        }, $this->items);

        return self::fromItems(...$items);
    }

    public static function itemClassName(): string
    {
        return FacebookCarouselVariant::class;
    }
}
