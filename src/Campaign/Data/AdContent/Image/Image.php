<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\Image;

use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;
use CCT\SDK\Infrastucture\ValueObject\Uri;
use CCT\SDK\MediaManagement\ViewModel\MediaImage;

final class Image extends AbstractMulti
{
    public function __construct(public readonly Uri $imageUrl, public readonly ImageId $uuid)
    {
    }

    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'image_url', 'image');
        Assertion::keyExists($data, 'uuid', 'image');

        return new self(
            Uri::fromString($data['image_url']),
            ImageId::fromString($data['uuid'])
        );
    }

    public static function fromMediaImage(MediaImage $mediaImage): self
    {
        $endpoint = $mediaImage->endpoint();
        Assertion::notNull($endpoint, 'image');

        return new self(
            Uri::fromString($endpoint),
            ImageId::fromString($mediaImage->id())
        );
    }

    public function toArray(): array
    {
        return [
            'image_url' => $this->imageUrl->toString(),
            'uuid' => $this->uuid->toString(),
        ];
    }
}
