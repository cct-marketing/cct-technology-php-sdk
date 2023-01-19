<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook;

use CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\DescriptionCollection;
use CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\HeadingCollection;
use CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\TextCollection;
use CCT\SDK\Campaign\Data\AdContent\Image\ImageCollection;
use CCT\SDK\Campaign\Data\AdContent\Video\VideoCollection;
use CCT\SDK\Infrastucture\Serialization\Caster\CastToCollectionObject;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class FacebookAiMultiAdVariant extends AbstractMulti
{
    public function __construct(
        #[CastToCollectionObject(TextCollection::class)]
        public readonly TextCollection $texts,
        #[CastToCollectionObject(HeadingCollection::class)]
        public readonly HeadingCollection $headings,
        #[CastToCollectionObject(DescriptionCollection::class)]
        public readonly DescriptionCollection $descriptions,
        #[CastToCollectionObject(ImageCollection::class)]
        public readonly ImageCollection $images,
        #[CastToCollectionObject(VideoCollection::class)]
        public readonly VideoCollection $videos
    ) {
    }
}
