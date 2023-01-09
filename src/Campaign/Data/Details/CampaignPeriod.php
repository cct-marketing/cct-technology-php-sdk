<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Details;

use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class CampaignPeriod extends AbstractMulti
{
    private const SERIALIZE_DATE_FORMAT = 'Y-m-d';

    public function __construct(public readonly \DateTimeInterface $startDate, public readonly \DateTimeInterface $endDate)
    {
    }

    /**
     * Gets the number of days between the two dates
     */
    public function lengthInDays(): int
    {
        return ((int) $this->endDate->diff($this->startDate)->format('%a')) + 1;
    }

    public function toArray(): array
    {
        return [
            'start_date' => $this->startDate->format(self::SERIALIZE_DATE_FORMAT),
            'end_date' => $this->endDate->format(self::SERIALIZE_DATE_FORMAT),
        ];
    }

    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'start_date', self::errorPropertyPath());
        Assertion::keyExists($data, 'end_date', self::errorPropertyPath());

        Assertion::date($data['start_date'], self::SERIALIZE_DATE_FORMAT, self::errorPropertyPath());
        Assertion::date($data['end_date'], self::SERIALIZE_DATE_FORMAT, self::errorPropertyPath());

        return new self(
            new \DateTimeImmutable($data['start_date']),
            new \DateTimeImmutable($data['end_date'])
        );
    }
}
