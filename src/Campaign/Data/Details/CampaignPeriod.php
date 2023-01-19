<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Details;

use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;
use EventSauce\ObjectHydrator\PropertyCasters\CastToDateTimeImmutable;

#[MapperSettings(serializePublicMethods: false)]
final class CampaignPeriod extends AbstractMulti
{
    private const SERIALIZE_DATE_FORMAT = 'Y-m-d';

    public function __construct(
        #[CastToDateTimeImmutable(self::SERIALIZE_DATE_FORMAT)]
        public readonly \DateTimeInterface $startDate,
        #[CastToDateTimeImmutable(self::SERIALIZE_DATE_FORMAT)]
        public readonly \DateTimeInterface $endDate
    ) {
    }

    /**
     * Gets the number of days between the two dates
     */
    public function lengthInDays(): int
    {
        return ((int) $this->endDate->diff($this->startDate)->format('%a')) + 1;
    }
}
