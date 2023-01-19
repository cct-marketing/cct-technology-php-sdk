<?php

declare(strict_types=1);

namespace CCT\SDK\Analytics\Response\Analytics;

use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class Impressions extends AbstractMulti
{
    public function __construct(
        public readonly int $impressions,
        public readonly int $impressionsCtr,
        public readonly array $impressionsByChannel,
        public readonly array $impressionsPerDay
    ) {
    }
}
