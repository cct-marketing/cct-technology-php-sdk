<?php

declare(strict_types=1);

namespace CCT\SDK\Analytics\Response\Analytics;

use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class Facebook extends AbstractMulti
{
    public function __construct(
        public readonly int $likesShares,
        public readonly int $fbLikes,
        public readonly int $fbShares,
        public readonly int $fbComments,
        public readonly array $fbGenderAgeRange
    ) {
    }
}
