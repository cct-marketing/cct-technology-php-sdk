<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ValueObject;

use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;
use DateInterval;
use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use Exception;
use LogicException;

final class DateTimeStamp extends AbstractValueObject
{
    public const FORMAT = DateTime::ATOM;

    /**
     * @var DateTimeImmutable
     */
    private $date;

    /**
     * @return DateTimeStamp
     *
     * @throws Exception
     */
    public static function now(): self
    {
        $date = new DateTimeImmutable();

        return new self($date);
    }

    /**
     * @param DateTimeImmutable $date
     *
     * @return DateTimeStamp
     */
    public static function fromDateTime(DateTimeImmutable $date): self
    {
        $date = self::ensureUTC($date);

        return new self($date);
    }

    /**
     * @param string $dateString
     *
     * @return DateTimeStamp
     */
    public static function fromString(string $dateString): self
    {
        $date = self::createFromString($dateString);

        if (false === $date) {
            throw new LogicException(
                'Failed to convert string to date:' . implode(', ', DateTimeImmutable::getLastErrors())
            );
        }

        $dateUTC = self::ensureUTC($date);

        return new self($dateUTC);
    }

    /**
     * Date constructor.
     *
     * @param DateTimeImmutable $date
     */
    private function __construct(DateTimeImmutable $date)
    {
        $this->date = $date;
    }

    /**
     * @param string $dateString
     *
     * @return DateTimeImmutable|false
     */
    private static function createFromString(string $dateString)
    {
        $formats = [self::FORMAT, 'Y-m-d h:i:s'];
        foreach ($formats as $format) {
            $date = DateTimeImmutable::createFromFormat(
                $format,
                $dateString,
                new DateTimeZone('UTC')
            );

            if ($date !== false) {
                return $date;
            }
        }

        return false;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->date->format(self::FORMAT);
    }

    /**
     * @return DateTimeImmutable
     */
    public function dateTime(): DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @param DateInterval $interval
     *
     * @return DateTimeStamp
     */
    public function add(DateInterval $interval): self
    {
        return new self($this->date->add($interval));
    }

    /**
     * @param DateInterval $interval
     *
     * @return DateTimeStamp
     */
    public function sub(DateInterval $interval): self
    {
        return new self($this->date->sub($interval));
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * @param DateTimeImmutable $date
     *
     * @return DateTimeImmutable
     */
    private static function ensureUTC(DateTimeImmutable $date): DateTimeImmutable
    {
        if ($date->getTimezone()->getName() === 'UTC') {
            return $date;
        }

        return $date->setTimezone(new DateTimeZone('UTC'));
    }

    /**
     * @param ValueObjectInterface $valueObject
     *
     * @return bool
     */
    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $this->toString() === $valueObject->toString();
    }
}
