<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\Request\Media;

use Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class RemoteMedia extends AbstractMulti implements CreateMediaInterface
{
    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'remote_file');
        Assertion::keyExists($data, 'type');

        return new self(
            BaseMediaCreate::fromArray($data),
            $data['remote_file']
        );
    }

    private function __construct(
        public readonly BaseMediaCreate $baseMediaCreate,
        public readonly string $remoteFile
    ) {
    }

    public function toArray(): array
    {
        return array_merge(
            $this->baseMediaCreate->toArray(),
            [
                'remote_file' => $this->remoteFile,
            ]
        );
    }
}
