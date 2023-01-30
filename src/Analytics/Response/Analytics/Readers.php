<?php

declare(strict_types=1);

namespace CCT\SDK\Analytics\Response\Analytics;

use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class Readers extends AbstractMulti
{
    public function __construct(
        public readonly int $readers,
        public readonly int $cctReaders,
        public readonly int $otherReaders,
        public readonly int $totalReaders
    ) {
    }
}
