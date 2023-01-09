<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\ViewModel;

use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;
use CCT\SDK\MediaManagement\ViewModel\Traits\BaseMediaGettersTrait;

final class MediaAudio extends AbstractMulti implements MediaInterface
{
    use BaseMediaGettersTrait;

    public function __construct(
        BaseMedia $baseMedia,
        public readonly ?int $contentSize,
        public readonly ?int $duration)
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            BaseMedia::fromArray($data),
            $data['content_size'] ?? null,
            $data['duration'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_merge(
            $this->baseMedia->toArray(),
            [
                'content_size' => $this->contentSize,
                'duration' => $this->duration,
            ]
        );
    }
}
