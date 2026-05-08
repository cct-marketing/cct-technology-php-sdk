<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\CampaignPhase;

use CCT\SDK\Infrastructure\ValueObject\ValueObjectInterface;

interface PhaseInterface extends ValueObjectInterface
{
    public function toArray(): array;
}
