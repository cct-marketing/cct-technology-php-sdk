<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\CampaignVideo;

use CCT\SDK\Campaign\Data\AdContent\Video\VideoCollection;
use CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject;
use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class CampaignVideos extends AbstractMulti
{
    public function __construct(
        #[CastToCollectionObject(VideoCollection::class)]
        public readonly VideoCollection $videos,
        public readonly bool $userSelected = true
    ) {
    }
}
