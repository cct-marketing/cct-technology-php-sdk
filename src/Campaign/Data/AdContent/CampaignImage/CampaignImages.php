<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\CampaignImage;

use CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\ChannelCollection;
use CCT\SDK\Campaign\Data\AdContent\Image\ImageCollection;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class CampaignImages extends AbstractMulti
{
    public function __construct(public readonly ChannelCollection $channelImages)
    {
    }

    public static function createEmpty(): self
    {
        return new self(ChannelCollection::emptyList());
    }

    public static function fromImages(ImageCollection $images)
    {
        return new self(ChannelCollection::allChannelsFromImages($images));
    }

    public function toArray(): array
    {
        return [
            'user_images_selected' => true,
            'channel_images' => $this->channelImages->toArray(),
        ];
    }

    public static function fromArray(array $data): static
    {
        return new self(
            ChannelCollection::fromArray($data['channel_images'] ?? []),
        );
    }
}
