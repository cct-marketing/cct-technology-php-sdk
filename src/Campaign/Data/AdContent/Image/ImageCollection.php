<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\Image;

use CCT\SDK\Infrastucture\ValueObject\AbstractCollection;
use CCT\SDK\MediaManagement\ViewModel\MediaCollection;
use CCT\SDK\MediaManagement\ViewModel\MediaImage;

final class ImageCollection extends AbstractCollection
{
    public static function fromMediaCollection(MediaCollection $mediaCollection): self
    {
        $images = [];
        foreach ($mediaCollection->items() as $mediaItem) {
            if (!$mediaItem instanceof MediaImage) {
                continue;
            }
            $images[] = Image::fromMediaImage($mediaItem);
        }

        return new self($images);
    }

    protected static function itemClassName(): string
    {
        return Image::class;
    }

    public function getAt(int $index): ?Image
    {
        return $this->values[$index] ?? null;
    }
}
