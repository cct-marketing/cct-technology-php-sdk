<?php

declare(strict_types=1);

namespace CCT\SDK\Analytics\Response\Analytics;

use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class Clicks extends AbstractMulti
{
    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'clicks', self::errorPropertyPath());
        Assertion::keyExists($data, 'clicks_per_day', self::errorPropertyPath());
        Assertion::keyExists($data, 'clicks_per_channel', self::errorPropertyPath());

        return new self(
            $data['clicks'],
            $data['clicks_per_day'],
            $data['clicks_per_channel']
        );
    }

    public function __construct(
        public readonly int $clicks,
        public readonly array $clicksPerDay,
        public readonly array $clicksPerChannel
    ) {
    }

    public function toArray(): array
    {
        return [
            'clicks' => $this->clicks,
            'clicks_per_day' => $this->clicksPerDay,
            'clicks_per_channel' => $this->clicksPerChannel,
        ];
    }
}
