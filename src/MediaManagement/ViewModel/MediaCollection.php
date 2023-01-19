<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\ViewModel;

use CCT\SDK\Infrastucture\Serialization\Caster\CastListUnionToType;
use CCT\SDK\Infrastucture\ValueObject\AbstractCollection;

final class MediaCollection extends AbstractCollection
{
    public function __construct(
        #[CastListUnionToType(['image' => MediaImage::class, 'video' => MediaVideo::class, 'document' => MediaDocument::class, 'audio' => MediaAudio::class])]
        array $items
    ) {
        parent::__construct($items);
    }

    #[CastListUnionToType(['image' => MediaImage::class, 'video' => MediaVideo::class, 'document' => MediaDocument::class, 'audio' => MediaAudio::class])]
    public function items(): array
    {
        return $this->items;
    }

    public static function itemClassName(): string
    {
        return MediaInterface::class;
    }
}
