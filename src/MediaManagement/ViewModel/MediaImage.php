<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\ViewModel;

use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;
use CCT\SDK\MediaManagement\ViewModel\Traits\BaseMediaGettersTrait;

final class MediaImage extends AbstractMulti implements MediaInterface
{
    use BaseMediaGettersTrait;

    public function __construct(
        BaseMedia $baseMedia,
        public readonly ?int $contentSize,
        public readonly ?int $width,
        public readonly ?int $height
    ) {
        $this->baseMedia = $baseMedia;
    }

    public static function fromArray(array $data): static
    {
        $data['type'] = 'image';

        return new self(
            BaseMedia::fromArray($data),
            $data['content_size'] ?? null,
            $data['width'] ?? null,
            $data['height'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_merge(
            $this->baseMedia->toArray(),
            [
                'content_size' => $this->contentSize,
                'width' => $this->width,
                'height' => $this->height,
            ]
        );
    }
}
