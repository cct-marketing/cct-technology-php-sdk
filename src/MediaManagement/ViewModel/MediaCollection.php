<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\ViewModel;

use CCT\SDK\Infrastucture\ValueObject\AbstractCollection;
use CCT\SDK\MediaManagement\ViewModel\Factory\MediaFactory;

final class MediaCollection extends AbstractCollection
{
    public static function fromArray(array $data): static
    {
        return new self(array_map(static function (array $medium) {
            return MediaFactory::fromArray($medium);
        }, $data));
    }

    public function toArray(): array
    {
        return array_map(
            static function (MediaInterface $medium) {
                return MediaFactory::toArray($medium);
            },
            $this->items
        );
    }

    protected static function itemClassName(): string
    {
        return MediaInterface::class;
    }
}
