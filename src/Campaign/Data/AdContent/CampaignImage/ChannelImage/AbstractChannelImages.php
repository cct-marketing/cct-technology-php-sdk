<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage;

use CCT\SDK\Campaign\Data\AdContent\Image\ImageCollection;
use CCT\SDK\Infrastucture\Serialization\Caster\CastToCollectionObject;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
abstract class AbstractChannelImages extends AbstractMulti implements ImageChannelInterface
{
    public const CHANNEL_NAME = 'general';

    public function __construct(
        #[CastToCollectionObject(ImageCollection::class)]
        public readonly ImageCollection $images
    ) {
    }

    public function getChannelName(): string
    {
        return static::CHANNEL_NAME;
    }

    public function count(): int
    {
        return $this->images->count();
    }
}
