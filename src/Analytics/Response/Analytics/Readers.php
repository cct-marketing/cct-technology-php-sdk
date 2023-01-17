<?php

declare(strict_types=1);

namespace CCT\SDK\Analytics\Response\Analytics;

use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class Readers extends AbstractMulti
{
    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'readers', self::errorPropertyPath());
        Assertion::keyExists($data, 'cct_readers', self::errorPropertyPath());
        Assertion::keyExists($data, 'other_readers', self::errorPropertyPath());
        Assertion::keyExists($data, 'total_readers', self::errorPropertyPath());

        return new self(
            $data['readers'],
            $data['cct_readers'],
            $data['other_readers'],
            $data['total_readers']
        );
    }

    public function __construct(
        public readonly int $readers,
        public readonly int $cctReaders,
        public readonly int $otherReaders,
        public readonly int $totalReaders
    ) {
    }

    public function toArray(): array
    {
        return [
            'readers' => $this->readers,
            'cct_readers' => $this->cctReaders,
            'other_readers' => $this->otherReaders,
            'total_readers' => $this->totalReaders,
        ];
    }
}
