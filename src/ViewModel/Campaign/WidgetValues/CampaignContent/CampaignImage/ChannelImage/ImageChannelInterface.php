<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\CampaignImage\ChannelImage;

use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ValueObject\ChannelName;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\Image\ImageCollection;

interface ImageChannelInterface
{
    /**
     * @return ImageChannelInterface
     */
    public static function fromArray(array $data);

    /**
     * @return array
     */
    public function toArray();

    public function equals(ValueObjectInterface $valueObject): bool;

    public function images(): ImageCollection;

    /**
     * Return the channel name.
     */
    public function getChannelName(): ChannelName;
}
