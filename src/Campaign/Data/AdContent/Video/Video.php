<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\Video;

use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;
use CCT\SDK\Infrastucture\ValueObject\Uri;

final class Video extends AbstractMulti
{
    public function __construct(public readonly Uri $videoUrl, public readonly VideoId $uuid)
    {
    }

    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'video_url', 'video');
        Assertion::keyExists($data, 'uuid', 'video');

        return new self(
            new Uri($data['video_url']),
            VideoId::fromString($data['uuid'])
        );
    }

    public function toArray(): array
    {
        return [
            'video_url' => $this->videoUrl->toString(),
            'uuid' => $this->uuid->toString(),
        ];
    }
}
