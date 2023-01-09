<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\Request\Media;

use CCT\SDK\Infrastucture\ValueObject\AbstractCollection;
use CCT\SDK\MediaManagement\ViewModel\MediaType;

final class MediaTypeCollection extends AbstractCollection
{
    public static function fromArray(array $data): static
    {
        return new self(array_map(static function (string $mediaType) {
            return MediaType::from($mediaType);
        }, $data));
    }

    public function toArray(): array
    {
        return array_map(
            static function (MediaType $mediaType) {
                return $mediaType->value;
            },
            $this->items
        );
    }

    protected static function itemClassName(): string
    {
        return MediaType::class;
    }
}
