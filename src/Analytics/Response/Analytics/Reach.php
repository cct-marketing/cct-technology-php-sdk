<?php

declare(strict_types=1);

namespace CCT\SDK\Analytics\Response\Analytics;

use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class Reach extends AbstractMulti
{
    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'reach', self::errorPropertyPath());
        Assertion::keyExists($data, 'reach_ctr', self::errorPropertyPath());

        return new self(
            $data['reach'],
            $data['reach_ctr']
        );
    }

    public function __construct(
        public readonly int $reach,
        public readonly int $reachCtr
    ) {
    }

    public function toArray(): array
    {
        return [
            'reach' => $this->reach,
            'reach_ctr' => $this->reachCtr,
        ];
    }
}