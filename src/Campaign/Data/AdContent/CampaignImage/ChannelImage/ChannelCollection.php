<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage;

use CCT\SDK\Campaign\Data\AdContent\Image\ImageCollection;
use CCT\SDK\Infrastucture\Serialization\Caster\CastListUnionToType;
use CCT\SDK\Infrastucture\ValueObject\AbstractCollection;

final class ChannelCollection extends AbstractCollection
{
    private static array $types = [
        'facebook_images' => FacebookImages::class,
        'google_images' => GoogleImages::class,
    ];

    public function __construct(
        #[CastListUnionToType(['facebook_images' => FacebookImages::class, 'google_images' => GoogleImages::class])]
        array $items
    ) {
        parent::__construct($items);
    }

    #[CastListUnionToType(['facebook_images' => FacebookImages::class, 'google_images' => GoogleImages::class])]
    public function items(): array
    {
        return $this->items;
    }

    public static function itemClassName(): string
    {
        return ImageChannelInterface::class;
    }

    public static function allChannelsFromImages(ImageCollection $images): self
    {
        $channel = [];
        foreach (self::$types as $className) {
            $channel[] = new $className($images);
        }

        return new self($channel);
    }
}
