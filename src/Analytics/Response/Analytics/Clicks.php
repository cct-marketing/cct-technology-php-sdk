<?php

declare(strict_types=1);

namespace CCT\SDK\Analytics\Response\Analytics;

use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class Clicks extends AbstractMulti
{
    public function __construct(
        public readonly int $clicks,
        public readonly array $clicksPerDay,
        public readonly array $clicksPerChannel
    ) {
    }
}
