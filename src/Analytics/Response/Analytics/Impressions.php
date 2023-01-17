<?php

declare(strict_types=1);

namespace CCT\SDK\Analytics\Response\Analytics;

use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class Impressions extends AbstractMulti
{
    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'impressions', self::errorPropertyPath());
        Assertion::keyExists($data, 'impressions_ctr', self::errorPropertyPath());
        Assertion::keyExists($data, 'impressions_by_channel', self::errorPropertyPath());
        Assertion::keyExists($data, 'impressions_per_day', self::errorPropertyPath());

        return new self(
            $data['impressions'],
            $data['impressions_ctr'],
            $data['impressions_by_channel'],
            $data['impressions_per_day']
        );
    }

    public function __construct(
        public readonly int $impressions,
        public readonly int $impressionsCtr,
        public readonly array $impressionsByChannel,
        public readonly array $impressionsPerDay
    ) {
    }

    public function toArray(): array
    {
        return [
            'impressions' => $this->impressions,
            'impressions_ctr' => $this->impressionsCtr,
            'impressions_by_channel' => $this->impressionsByChannel,
            'impressions_per_day' => $this->impressionsPerDay,
        ];
    }
}
