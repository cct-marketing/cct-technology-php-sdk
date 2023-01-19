<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\Image;

use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\Serialization\Caster\CastToSingleValueObject;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;
use CCT\SDK\Infrastucture\ValueObject\Uri;
use CCT\SDK\MediaManagement\ViewModel\MediaImage;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class Image extends AbstractMulti
{
    public function __construct(
        #[CastToSingleValueObject(Uri::class)]
        public readonly Uri $imageUrl,
        #[CastToSingleValueObject(ImageId::class)]
        public readonly ImageId $uuid
    ) {
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
}
