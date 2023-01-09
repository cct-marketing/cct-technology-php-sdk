<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\ViewModel;

use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;
use CCT\SDK\MediaManagement\ViewModel\Traits\BaseMediaGettersTrait;

final class MediaFacebookVideo extends AbstractMulti implements MediaInterface
{
    use BaseMediaGettersTrait;

    public function __construct(
        BaseMedia $baseMedia,
        public readonly ?int $facebookVideoId,
        public readonly ?int $duration
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new self(
            BaseMedia::fromArray($data),
            $data['facebook_video_id'] ?? null,
            $data['duration'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_merge(
            $this->baseMedia->toArray(),
            [
                'facebook_video_id' => $this->facebookVideoId,
                'duration' => $this->duration,
            ]
        );
    }
}
