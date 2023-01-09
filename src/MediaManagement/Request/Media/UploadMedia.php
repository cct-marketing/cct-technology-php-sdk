<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\Request\Media;

use Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class UploadMedia extends AbstractMulti implements CreateMediaInterface
{
    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'name');
        Assertion::keyExists($data, 'file_resource');
        Assertion::keyExists($data, 'file_name');
        Assertion::keyExists($data, 'type');

        return new self(
            BaseMediaCreate::fromArray($data),
            $data['file_resource'],
            $data['file_name']
        );
    }

    private function __construct(
        public readonly BaseMediaCreate $baseMediaCreate,
        public readonly mixed $fileResource,
        public readonly string $fileName
    ) {
        Assertion::isResource($fileResource);
    }

    public function toArray(): array
    {
        return array_merge(
            $this->baseMediaCreate->toArray(),
            [
                'file_resource' => $this->fileResource,
                'file_name' => $this->fileName,
            ]
        );
    }

    public function toMultipart(): array
    {
        return array_merge(
            $this->baseMediaCreate->toMultipart(),
            [[
                'name' => 'media[file]',
                'contents' => $this->fileResource,
                'filename' => $this->fileName,
            ]]
        );
    }
}
