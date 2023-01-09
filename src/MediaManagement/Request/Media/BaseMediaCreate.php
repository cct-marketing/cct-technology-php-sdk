<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\Request\Media;

use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;
use CCT\SDK\MediaManagement\ViewModel\MediaType;

final class BaseMediaCreate extends AbstractMulti
{
    public static function fromArray(array $data): static
    {
        return new self(
            $data['id'] ?? null,
            $data['name'] ?? null,
            $data['description'] ?? null,
            $data['private'] ?? false,
            isset($data['type']) ? MediaType::from($data['type']) : null,
            $data['predefined_name'] ?? null
        );
    }

    public static function create(
        MediaType $type,
        bool $private,
        ?string $predefinedName,
        ?string $id,
        ?string $name,
        ?string $description
    ): self {
        return new self(
            $id,
            $name,
            $description,
            $private,
            $type,
            $predefinedName
        );
    }

    private function __construct(
        public readonly ?string $id,
        public readonly ?string $name,
        public readonly ?string $description,
        public readonly bool $private,
        public readonly ?MediaType $type,
        public readonly ?string $predefinedName
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'private' => $this->private,
            'type' => $this->type?->value,
            'predefined_name' => $this->predefinedName,
        ];
    }

    public function toMultipart(): array
    {
        $multipartData = [];

        foreach ($this->toArray() as $field => $value) {
            if (null === $value) {
                continue;
            }

            if (is_array($value)) {
                foreach ($value as $item) {
                    foreach ($item as $propertyName => $subValue) {
                        if (null === $subValue) {
                            continue;
                        }
                        $multipartData[] = [
                            'name' => sprintf('media[%s][][%s]', $field, $propertyName),
                            'contents' => $subValue,
                        ];
                    }
                }

                continue;
            }

            $multipartData[] = [
                'name' => sprintf('media[%s]', $field),
                'contents' => $value,
            ];
        }

        return $multipartData;
    }
}
