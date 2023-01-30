<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent;

use CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\FacebookAiMultiAdVariants;
use CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel\FacebookCarouselVariants;
use CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleResponsiveAdVariants;
use CCT\SDK\Campaign\Data\AdContent\AdVariant\LinkedIn\LinkedInAdVariants;
use CCT\SDK\Campaign\Data\AdContent\AdVariant\Twitter\TwitterAdVariants;
use CCT\SDK\Campaign\Data\AdContent\CampaignImage\CampaignImages;
use CCT\SDK\Campaign\Data\AdContent\CampaignVideo\CampaignVideos;
use CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject;
use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class AdContent extends AbstractMulti
{
    public function __construct(
        public readonly ?CampaignImages $campaignImages,
        public readonly ?CampaignVideos $campaignVideos,
        #[CastToCollectionObject(FacebookAiMultiAdVariants::class)]
        public readonly ?FacebookAiMultiAdVariants $facebookAiMultiAdVariants,
        #[CastToCollectionObject(FacebookCarouselVariants::class)]
        public readonly ?FacebookCarouselVariants $facebookCarouselVariants,
        public readonly ?AdText $adText,
        #[CastToCollectionObject(LinkedInAdVariants::class)]
        public readonly ?LinkedInAdVariants $linkedInAdVariants,
        #[CastToCollectionObject(TwitterAdVariants::class)]
        public readonly ?TwitterAdVariants $twitterAdVariants,
        #[CastToCollectionObject(GoogleResponsiveAdVariants::class)]
        public readonly ?GoogleResponsiveAdVariants $googleResponsiveAdVariants
    ) {
    }
}
