<?php

declare(strict_types=1);

namespace CCT\SDK\Analytics\Response\Analytics;

use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class Target extends AbstractMulti
{
    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'target_group_size', self::errorPropertyPath());
        Assertion::keyExists($data, 'average_time', self::errorPropertyPath());

        return new self(
            $data['target_group_size'],
            $data['average_time']
        );
    }

    public function __construct(
        public readonly int $targetGroupSize,
        public readonly int $averageTime
    ) {
    }

    public function toArray(): array
    {
        return [
            'target_group_size' => $this->targetGroupSize,
            'average_time' => $this->averageTime,
        ];
    }
}
