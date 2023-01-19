<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\CampaignImage;

use CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\ChannelCollection;
use CCT\SDK\Campaign\Data\AdContent\Image\ImageCollection;
use CCT\SDK\Infrastucture\Serialization\Caster\CastToCollectionObject;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class CampaignImages extends AbstractMulti
{
    public function __construct(
        #[CastToCollectionObject(ChannelCollection::class)]
        public readonly ?ChannelCollection $channelImages,
        public readonly bool $userImagesSelected = true
    ) {
    }

    public static function createEmpty(): self
    {
        return new self(ChannelCollection::emptyList());
    }

    public static function fromImages(ImageCollection $images): self
    {
        return new self(ChannelCollection::allChannelsFromImages($images));
    }
}
