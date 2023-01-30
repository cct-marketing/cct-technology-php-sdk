<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage;

use CCT\SDK\Infrastructure\ValueObject\ValueObjectInterface;

interface ImageChannelInterface extends ValueObjectInterface
{
    public function getChannelName(): string;

    public function toArray(): array;
}
