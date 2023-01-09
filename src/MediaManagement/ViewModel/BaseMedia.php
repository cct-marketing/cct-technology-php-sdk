<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\ViewModel;

use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class BaseMedia extends AbstractMulti
{
    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'id', self::errorPropertyPath());
        Assertion::keyExists($data, 'name', self::errorPropertyPath());
        Assertion::keyExists($data, 'private', self::errorPropertyPath());
        Assertion::keyExists($data, 'status', self::errorPropertyPath());
        Assertion::keyExists($data, 'type', self::errorPropertyPath());

        return new self(
            $data['id'],
            $data['name'],
            $data['description'] ?? null,
            $data['private'],
            $data['extension'] ?? null,
            Status::from($data['status']),
            $data['external'] ?? false,
            isset($data['contexts']) ? ContextCollection::fromArray($data['contexts']) : null,
            MediaType::from($data['type']),
            $data['endpoint'] ?? null,
            $data['file_format'] ?? null,
            $data['original_uri'] ?? null
        );
    }

    private function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly ?string $description,
        public readonly bool $private,
        public readonly ?string $extension,
        public readonly Status $status,
        public readonly bool $external,
        public readonly ?ContextCollection $contexts,
        public readonly MediaType $type,
        public readonly ?string $endpoint,
        public readonly ?string $fileFormat,
        public readonly ?string $originalUri
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'private' => $this->private,
            'extension' => $this->extension,
            'status' => $this->status->value,
            'external' => $this->external,
            'contexts' => $this->contexts?->toArray(),
            'type' => $this->type->value,
            'endpoint' => $this->endpoint,
            'file_format' => $this->fileFormat,
            'original_uri' => $this->originalUri,
        ];
    }
}
