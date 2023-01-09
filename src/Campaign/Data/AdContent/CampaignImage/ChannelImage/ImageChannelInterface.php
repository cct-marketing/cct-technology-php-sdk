<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage;

use CCT\SDK\Infrastucture\ValueObject\ValueObjectInterface;

interface ImageChannelInterface extends ValueObjectInterface
{
    public function getChannelName(): string;

    public function toArray(): array;
}
