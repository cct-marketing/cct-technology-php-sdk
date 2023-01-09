<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage;

use CCT\SDK\Campaign\Data\AdContent\Image\ImageCollection;
use CCT\SDK\Infrastucture\ValueObject\AbstractCollection;

final class ChannelCollection extends AbstractCollection
{
    private static array $types = [
        'facebook_images' => FacebookImages::class,
        'google_images' => GoogleImages::class,
        'linked_in_images' => LinkedInImages::class,
        'twitter_images' => TwitterImages::class,
    ];

    public static function fromArray(array $data): static
    {
        return new self(\array_map(static function (array $item) {
            if (!isset($item['_type'], self::$types[$item['_type']])) {
                throw new \RuntimeException(
                    sprintf(
                        'You must have a _type key with one of the following values "%s"',
                        implode(', ', array_keys(self::$types))
                    )
                );
            }

            $className = self::$types[$item['_type']];

            return $className::fromArray($item);
        }, $data));
    }

    public static function allChannelsFromImages(ImageCollection $images): self
    {
        $channel = array_values(\array_map(static function (string $className) use ($images) {
            return new $className($images);
        }, self::$types));

        return new self($channel);
    }

    public function toArray(): array
    {
        return \array_map(static function (ImageChannelInterface $item) {
            $data = $item->toArray();
            $data['_type'] = array_search(get_class($item), self::$types, true);

            return $data;
        }, $this->items);
    }

    protected static function itemClassName(): string
    {
        return ImageChannelInterface::class;
    }
}
