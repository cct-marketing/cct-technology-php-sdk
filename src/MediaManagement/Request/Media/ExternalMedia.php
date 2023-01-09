<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\Request\Media;

use Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class ExternalMedia extends AbstractMulti implements CreateMediaInterface
{
    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'external_url');
        Assertion::keyExists($data, 'type');

        return new self(
            BaseMediaCreate::fromArray($data),
            $data['external_url']
        );
    }

    private function __construct(
        public readonly BaseMediaCreate $baseMediaCreate,
        public readonly string $externalUrl
    ) {
    }

    public function toArray(): array
    {
        return array_merge(
            $this->baseMediaCreate->toArray(),
            [
                'external_url' => $this->externalUrl,
            ]
        );
    }
}
