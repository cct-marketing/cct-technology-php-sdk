<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\CampaignPhase;

use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;
use EventSauce\ObjectHydrator\PropertyCasters\CastToDateTimeImmutable;

#[MapperSettings(serializePublicMethods: false)]
final class OpenHouse extends AbstractMulti implements PhaseInterface
{
    private const SERIALIZE_DATE_FORMAT = \DateTimeInterface::ATOM;

    public function __construct(
        #[CastToDateTimeImmutable(self::SERIALIZE_DATE_FORMAT)]
        public readonly \DateTimeInterface $startDate,
        #[CastToDateTimeImmutable(self::SERIALIZE_DATE_FORMAT)]
        public readonly \DateTimeInterface $endDate
    ) {
        if ($this->startDate > $this->endDate) {
            throw new \InvalidArgumentException(sprintf(
                'Open House start date "%s" cannot be after end date "%s"',
                $this->startDate->format('Y-m-d H:i:s'),
                $this->endDate->format('Y-m-d H:i:s')
            ));
        }
    }

    public function lengthInDays(): int
    {
        return ((int) $this->endDate->diff($this->startDate)->format('%a')) + 1;
    }
}
