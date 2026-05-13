<?php

declare(strict_types=1);

namespace CCT\SDK\Analytics\Response\Analytics;

use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class VideoQuartiles extends AbstractMulti
{
    public function __construct(
        public readonly int $plays,
        public readonly int $p25,
        public readonly int $p50,
        public readonly int $p75,
        public readonly int $p100,
        public readonly array $videoQuartilesPerChannel,
        public readonly array $videoQuartilesPerDay
    ) {
    }
}
