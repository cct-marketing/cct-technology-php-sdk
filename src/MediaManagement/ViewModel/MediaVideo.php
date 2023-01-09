<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\ViewModel;

use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;
use CCT\SDK\MediaManagement\ViewModel\Traits\BaseMediaGettersTrait;

final class MediaVideo extends AbstractMulti implements MediaInterface
{
    use BaseMediaGettersTrait;

    public function __construct(
        BaseMedia $baseMedia,
        public readonly ?int $contentSize,
        public readonly ?int $width,
        public readonly ?int $height,
        public readonly ?int $duration,
        public readonly ?float $frameRate,
        public readonly ?string $posterUrl
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new self(
            BaseMedia::fromArray($data),
            $data['content_size'] ?? null,
            $data['width'] ?? null,
            $data['height'] ?? null,
            $data['duration'] ?? null,
            $data['frame_rate'] ?? null,
            $data['poster_url'] ?? null
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
                'duration' => $this->duration,
                'frame_rate' => $this->frameRate,
                'poster_url' => $this->posterUrl,
            ]
        );
    }
}
