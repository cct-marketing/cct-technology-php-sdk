<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\AdVariant\Google;

use CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\DescriptionCollection;
use CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\LongHeadline;
use CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\ShortHeadlineCollection;
use CCT\SDK\Campaign\Data\AdContent\Image\ImageCollection;
use CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject;
use CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject;
use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class GoogleResponsiveAdVariant extends AbstractMulti
{
    public function __construct(
        #[CastToCollectionObject(ShortHeadlineCollection::class)]
        public readonly ShortHeadlineCollection $shortHeadlines,
        #[CastToSingleValueObject(LongHeadline::class)]
        public readonly LongHeadline $longHeadline,
        #[CastToCollectionObject(DescriptionCollection::class)]
        public readonly DescriptionCollection $descriptions,
        #[CastToCollectionObject(ImageCollection::class)]
        public readonly ImageCollection $images
    ) {
    }
}
