<?php

declare(strict_types=1);

namespace CCT\SDK\Analytics\Response;

use CCT\SDK\Analytics\Response\Analytics\Clicks;
use CCT\SDK\Analytics\Response\Analytics\Facebook;
use CCT\SDK\Analytics\Response\Analytics\Impressions;
use CCT\SDK\Analytics\Response\Analytics\Reach;
use CCT\SDK\Analytics\Response\Analytics\Readers;
use CCT\SDK\Analytics\Response\Analytics\Target;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class Analytics extends AbstractMulti
{
    public function __construct(
        public readonly Clicks $clicks,
        public readonly Facebook $facebook,
        public readonly Impressions $impressions,
        public readonly Reach $reach,
        public readonly Readers $readers,
        public readonly Target $target
    ) {
    }
}
