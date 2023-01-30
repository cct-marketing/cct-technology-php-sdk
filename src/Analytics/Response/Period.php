<?php

declare(strict_types=1);

namespace CCT\SDK\Analytics\Response;

use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class Period extends AbstractMulti
{
    public function __construct(
        public readonly \DateTimeImmutable $startDate,
        public readonly \DateTimeImmutable $endDate,
        public readonly \DateTimeImmutable $createdAt,
    ) {
    }

    /**
     * @psalm-suppress PossiblyFalseArgument
     */
    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'start_date', self::errorPropertyPath());
        Assertion::keyExists($data, 'end_date', self::errorPropertyPath());
        Assertion::keyExists($data, 'created_at', self::errorPropertyPath());

        return new self(
            \DateTimeImmutable::createFromFormat(\DateTimeInterface::ATOM, $data['start_date']),
            \DateTimeImmutable::createFromFormat(\DateTimeInterface::ATOM, $data['end_date']),
            \DateTimeImmutable::createFromFormat(\DateTimeInterface::ATOM, $data['created_at'])
        );
    }

    public function toArray(): array
    {
        return [
            'start_date' => $this->startDate->format(\DateTimeInterface::ATOM),
            'end_date' => $this->endDate->format(\DateTimeInterface::ATOM),
            'created_at' => $this->createdAt->format(\DateTimeInterface::ATOM),
        ];
    }
}
