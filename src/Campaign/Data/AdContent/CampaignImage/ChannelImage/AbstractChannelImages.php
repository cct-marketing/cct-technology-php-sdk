<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage;

use CCT\SDK\Campaign\Data\AdContent\Image\ImageCollection;
use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

abstract class AbstractChannelImages extends AbstractMulti implements ImageChannelInterface
{
    public const CHANNEL_NAME = 'general';

    public function __construct(protected readonly ImageCollection $images)
    {
    }

    public function getChannelName(): string
    {
        return static::CHANNEL_NAME;
    }

    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'images', self::errorPropertyPath());

        return new static(
            ImageCollection::fromArray($data['images'])
        );
    }

    public function toArray(): array
    {
        return [
            'images' => $this->images->toArray(),
        ];
    }

    public function count(): int
    {
        return $this->images->count();
    }
}
