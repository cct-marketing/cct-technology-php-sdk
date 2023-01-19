<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\Request\Media;

use CCT\SDK\Infrastucture\Serialization\Caster\CastListUnionToType;
use CCT\SDK\Infrastucture\ValueObject\AbstractCollection;
use CCT\SDK\MediaManagement\Exception\InvalidCreateRequestException;
use EventSauce\ObjectHydrator\DoNotSerialize;

final class CreateMediaCollection extends AbstractCollection
{
    public function __construct(
        #[CastListUnionToType([
            'remote_file' => RemoteMedia::class,
            'external_url' => ExternalMedia::class,
            'file_resource' => UploadMedia::class,
        ])]
        array $items
    ) {
        parent::__construct($items);
    }

    #[CastListUnionToType([
        'remote_file' => RemoteMedia::class,
        'external_url' => ExternalMedia::class,
        'file_resource' => UploadMedia::class,
    ])]
    public function items(): array
    {
        return $this->items;
    }

    #[DoNotSerialize]
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

    public static function itemClassName(): string
    {
        return CreateMediaInterface::class;
    }
}
