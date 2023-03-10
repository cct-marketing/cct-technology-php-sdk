<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage;

use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class GoogleImages extends AbstractChannelImages
{
    public const CHANNEL_NAME = 'google';
}
