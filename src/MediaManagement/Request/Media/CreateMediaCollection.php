<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\Request\Media;

use CCT\SDK\Infrastucture\ValueObject\AbstractCollection;
use CCT\SDK\MediaManagement\Exception\InvalidCreateRequestException;
use CCT\SDK\MediaManagement\Request\Factory\CreateMediaFactory;

final class CreateMediaCollection extends AbstractCollection
{
    public static function fromArray(array $data): static
    {
        return new self(array_map(static function (array $media) {
            return CreateMediaFactory::fromArray($media);
        }, $data));
    }

    public function toArray(): array
    {
        return array_map(
            static function (CreateMediaInterface $media) {
                return $media->toArray();
            },
            $this->items
        );
    }

    public function toFormParam(): array
    {
        return array_map(
            static function (CreateMediaInterface $media) {
                if ($media instanceof UploadMedia) {
                    throw InvalidCreateRequestException::mediaUploadNotAllowed($media);
                }

                return array_filter($media->toArray(), static function ($value) {
                    return null !== $value;
                });
            },
            $this->items
        );
    }

    protected static function itemClassName(): string
    {
        return CreateMediaInterface::class;
    }
}
