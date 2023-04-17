<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignFlow\Data;

final class PeriodSettings
{
    public function __construct(
        public readonly int $minOffsetInDays,
        public readonly int $maxLengthInDays,
        public readonly int $defaultLengthInDays,
    ) {
    }
}
