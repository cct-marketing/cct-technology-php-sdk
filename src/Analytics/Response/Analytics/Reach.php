<?php

declare(strict_types=1);

namespace CCT\SDK\Analytics\Response\Analytics;

use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class Reach extends AbstractMulti
{
    public function __construct(
        public readonly int $reach,
        public readonly int $reachCtr,
        public readonly float $reachCtrDecimal,
        public readonly array $reachByChannel
    ) {
    }
}
