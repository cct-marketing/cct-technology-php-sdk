<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\ViewModel;

use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;
use CCT\SDK\MediaManagement\ViewModel\Traits\BaseMediaGettersTrait;

final class MediaDocument extends AbstractMulti implements MediaInterface
{
    use BaseMediaGettersTrait;

    public function __construct(
        BaseMedia $baseMedia,
        public readonly ?int $contentSize
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new self(
            BaseMedia::fromArray($data),
            $data['content_size'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_merge(
            $this->baseMedia->toArray(),
            [
                'content_size' => $this->contentSize,
            ]
        );
    }
}
