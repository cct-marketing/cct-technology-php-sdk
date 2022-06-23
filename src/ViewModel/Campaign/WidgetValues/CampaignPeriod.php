<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues;

use Assert\Assertion;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;
use DateTimeImmutable;
use DateTimeInterface;
use Exception;

final class CampaignPeriod extends AbstractValueObject
{
    private const SERIALIZE_DATE_FORMAT = 'Y-m-d';

    /**
     * Internal 'start' DateTime
     *
     * @var DateTimeInterface
     */
    private $startDate;

    /**
     * Internal 'end' DateTime
     *
     * @var DateTimeInterface
     */
    private $endDate;

    /**
     * Create a DateRange from a start date and an end date
     *
     * @param DateTimeInterface $start Start date
     * @param DateTimeInterface $end   End date
     */
    public function __construct(DateTimeInterface $start, DateTimeInterface $end)
    {
        $this->startDate = $start;
        $this->endDate = $end;
    }

    public function startDate(): DateTimeInterface
    {
        return $this->startDate;
    }

    public function endDate(): DateTimeInterface
    {
        return $this->endDate;
    }

    /**
     * @param ValueObjectInterface|self $valueObject
     */
    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $valueObject->toArray() === $this->toArray();
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

    /**
     * {@inheritDoc}
     *
     * @throws Exception
     */
    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'start_date', null, self::errorPropertyPath());
        Assertion::keyExists($data, 'end_date', null, self::errorPropertyPath());

        Assertion::date($data['start_date'], self::SERIALIZE_DATE_FORMAT, null, self::errorPropertyPath());
        Assertion::date($data['end_date'], self::SERIALIZE_DATE_FORMAT, null, self::errorPropertyPath());

        return new self(
            new DateTimeImmutable($data['start_date']),
            new DateTimeImmutable($data['end_date'])
        );
    }
}
