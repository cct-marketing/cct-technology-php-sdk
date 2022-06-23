<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\Video;

use CCT\Component\ValueObject\ValueObjectInterface;

interface VideoInterface extends ValueObjectInterface
{
    public function uuid(): string;

    public function toArray(): array;
}