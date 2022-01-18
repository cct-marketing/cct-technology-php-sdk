<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\CampaignImage\ChannelImage;

use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\Image\ImageCollection;

interface ImageChannelInterface
{
    /**
     * @param array $data
     *
     * @return ImageChannelInterface
     */
    public static function fromArray(array $data);

    /**
     * @return array
     */
    public function toArray();

    /**
     * @param ValueObjectInterface $valueObject
     *
     * @return bool
     */
    public function equals(ValueObjectInterface $valueObject): bool;

    /**
     * @return ImageCollection
     */
    public function images(): ImageCollection;
}
