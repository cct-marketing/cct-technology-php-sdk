<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\AdVariant\LinkedIn;

use CCT\SDK\Campaign\Data\AdContent\Image\ImageCollection;
use CCT\SDK\Infrastructure\Assert\Assertion;
use CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject;
use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class LinkedInAdVariant extends AbstractMulti
{
    public function __construct(
        public readonly string $text,
        #[CastToCollectionObject(ImageCollection::class)]
        public readonly ?ImageCollection $images
    ) {
        $this->guard($text);
    }

    private function guard(string $text): void
    {
        Assertion::maxLength($text, 200, 'linked_in_ad_variant');
    }
}
