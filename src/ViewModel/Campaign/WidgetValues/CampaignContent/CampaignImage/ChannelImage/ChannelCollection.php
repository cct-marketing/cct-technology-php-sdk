<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\CampaignImage\ChannelImage;

use ArrayIterator;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ValueObject\ChannelName;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\Image\Image;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\Image\ImageCollection;
use RuntimeException;
use function array_map;
use function array_pop;
use function json_encode;

final class ChannelCollection extends AbstractValueObject
{
    private static $types = [
        'facebook_images' => FacebookImages::class,
        'google_images' => GoogleImages::class,
        'linked_in_images' => LinkedInImages::class,
        'twitter_images' => TwitterImages::class,
    ];

    /**
     * @var ImageChannelInterface[]
     */
    private $items;

    public static function fromArray(array $items): self
    {
        return new self(...array_map(static function (array $item) {
            if (!isset($item['_type'], self::$types[$item['_type']])) {
                throw new RuntimeException(
                    sprintf(
                        'You must have a _type key with one of the following values "%s"',
                        implode(', ', array_keys(self::$types))
                    )
                );
            }

            $className = self::$types[$item['_type']];

            return $className::fromArray($item);
        }, $items));
    }

    public static function fromItems(ImageChannelInterface ...$items): self
    {
        return new self(...$items);
    }

    public static function emptyList(): self
    {
        return new self();
    }

    private function __construct(ImageChannelInterface ...$items)
    {
        $this->items = $items;
    }

    public function push(ImageChannelInterface $item): self
    {
        $copy = clone $this;
        $copy->items[] = $item;

        return $copy;
    }

    public function pop(): self
    {
        $copy = clone $this;
        array_pop($copy->items);

        return $copy;
    }

    public function first(): ?ImageChannelInterface
    {
        return $this->items[0] ?? null;
    }

    public function last(): ?ImageChannelInterface
    {
        if (count($this->items) === 0) {
            return null;
        }

        return $this->items[count($this->items) - 1];
    }

    public function contains(ImageChannelInterface $item): bool
    {
        if (!$item instanceof ValueObjectInterface) {
            return false;
        }

        foreach ($this->items as $existingItem) {
            if ($existingItem->equals($item)) {
                return true;
            }
        }

        return false;
    }

    public function toArray(): array
    {
        return array_map(static function (ImageChannelInterface $item) {
            $data = $item->toArray();
            $data['_type'] = array_search(get_class($item), self::$types, true);

            return $data;
        }, $this->items);
    }

    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $this->toArray() === $valueObject->toArray();
    }

    public function __toString(): string
    {
        return (string) json_encode($this->toArray());
    }

    public function getByChannelName(ChannelName $channelName): ?ImageChannelInterface
    {
        $channels = array_filter($this->items, static function (ImageChannelInterface $channel) use ($channelName) {
            return $channel->getChannelName()->equals($channelName);
        });

        $result = self::fromItems(...$channels);

        return $result->count() > 0 ? $result->first() : null;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items);
    }

    /**
     * Gets all unique images from each channel and adds to a single image collection
     */
    public function allImages(): ImageCollection
    {
        $imageCollections = array_map(static function (ImageChannelInterface $imageChannel) {
            return $imageChannel->images()->images();
        }, $this->items);

        $images = array_merge(...$imageCollections);

        $imageIds = array_map(static function (Image $image) {
            return $image->getUuid();
        }, $images);

        $uniqueImageIds = array_unique($imageIds);

        $uniqueImages = array_values(array_intersect_key($images, $uniqueImageIds));

        return ImageCollection::fromItems(...$uniqueImages);
    }
}
