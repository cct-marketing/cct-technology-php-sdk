<?php

declare(strict_types=1);

namespace CCT\SDK\Analytics\Response;

use CCT\SDK\Analytics\Response\Analytics\Clicks;
use CCT\SDK\Analytics\Response\Analytics\Facebook;
use CCT\SDK\Analytics\Response\Analytics\Impressions;
use CCT\SDK\Analytics\Response\Analytics\Reach;
use CCT\SDK\Analytics\Response\Analytics\Readers;
use CCT\SDK\Analytics\Response\Analytics\Target;
use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class Analytics extends AbstractMulti
{
    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'clicks', self::errorPropertyPath());
        Assertion::keyExists($data, 'facebook', self::errorPropertyPath());
        Assertion::keyExists($data, 'impressions', self::errorPropertyPath());
        Assertion::keyExists($data, 'reach', self::errorPropertyPath());
        Assertion::keyExists($data, 'readers', self::errorPropertyPath());
        Assertion::keyExists($data, 'target', self::errorPropertyPath());

        return new self(
            Clicks::fromArray($data['clicks']),
            Facebook::fromArray($data['facebook']),
            Impressions::fromArray($data['impressions']),
            Reach::fromArray($data['reach']),
            Readers::fromArray($data['readers']),
            Target::fromArray($data['target'])
        );
    }

    public function __construct(
        public readonly Clicks $clicks,
        public readonly Facebook $facebook,
        public readonly Impressions $impressions,
        public readonly Reach $reach,
        public readonly Readers $readers,
        public readonly Target $target
    ) {
    }

    public function toArray(): array
    {
        return [
            'clicks' => $this->clicks->toArray(),
            'facebook' => $this->facebook->toArray(),
            'impressions' => $this->impressions->toArray(),
            'reach' => $this->reach->toArray(),
            'readers' => $this->readers->toArray(),
            'target' => $this->target->toArray(),
        ];
    }
}
