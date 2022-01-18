<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\Options\CampaignPhase;

use Assert\Assertion;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;
use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use Exception;
use RuntimeException;

final class OpenHouse extends AbstractValueObject
{
    private const SERIALIZE_DATE_FORMAT = DateTime::ATOM;

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
        $this->guard($start, $end);

        $this->startDate = $start;
        $this->endDate = $end;
    }

    /**
     * @return DateTimeInterface
     */
    public function getStartDate(): DateTimeInterface
    {
        return $this->startDate;
    }

    /**
     * @return DateTimeInterface
     */
    public function getEndDate(): DateTimeInterface
    {
        return $this->endDate;
    }

    /**
     * @param ValueObjectInterface|self $valueObject
     *
     * @return bool
     */
    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $this->toArray() === $valueObject->toArray();
    }

    /**
     * Gets the number of days between the two dates
     *
     * @return int
     */
    public function lengthInDays(): int
    {
        return ((int) $this->endDate->diff($this->startDate)->format('%a')) + 1;
    }

    /**
     * @param DateTimeInterface $startDate
     * @param DateTimeInterface $endDate
     */
    private function guard($startDate, $endDate): void
    {
        if ($startDate > $endDate) {
            throw new RuntimeException('Start date cannot be after enddate');
        }
    }

    /**
     * @return array
     */
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
    public static function fromArray(array $data): ?OpenHouse
    {
        Assertion::date($data['start_date'], self::SERIALIZE_DATE_FORMAT, null, 'campaign_phase');
        Assertion::date($data['end_date'], self::SERIALIZE_DATE_FORMAT, null, 'campaign_phase');

        return new self(
            new DateTimeImmutable($data['start_date']),
            new DateTimeImmutable($data['end_date'])
        );
    }
}
