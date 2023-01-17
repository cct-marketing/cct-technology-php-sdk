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

    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'start_date', self::errorPropertyPath());
        Assertion::keyExists($data, 'end_date', self::errorPropertyPath());
        Assertion::keyExists($data, 'created_at', self::errorPropertyPath());

        return new self(
            (new \DateTimeImmutable())->setTimestamp($data['start_date']),
            (new \DateTimeImmutable())->setTimestamp($data['end_date']),
            (new \DateTimeImmutable())->setTimestamp($data['created_at'])
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
