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
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class AdContent extends AbstractMulti
{
    public function __construct(
        public readonly ?CampaignImages $campaignImages,
        public readonly ?CampaignVideos $campaignVideos,
        public readonly ?FacebookAiMultiAdVariants $facebookAiMultiAdVariants,
        public readonly ?FacebookCarouselVariants $facebookCarouselVariants,
        public readonly ?AdText $adText,
        public readonly ?LinkedInAdVariants $linkedInAdVariants,
        public readonly ?TwitterAdVariants $twitterAdVariants,
        public readonly ?GoogleResponsiveAdVariants $googleResponsiveAdVariants
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new self(
            isset($data['campaign_images']) ? CampaignImages::fromArray($data['campaign_images']) : null,
            isset($data['campaign_videos']) ? CampaignVideos::fromArray($data['campaign_videos']) : null,
            isset($data['facebook_ai_multi_ad_variants'])
                ? FacebookAiMultiAdVariants::fromArray($data['facebook_ai_multi_ad_variants']) : null,
            isset($data['facebook_carousel_variants'])
                ? FacebookCarouselVariants::fromArray($data['facebook_carousel_variants']) : null,
            isset($data['ad_text']) ? AdText::fromArray($data['ad_text']) : null,
            isset($data['linked_in_ad_variants'])
                ? LinkedInAdVariants::fromArray($data['linked_in_ad_variants']) : null,
            isset($data['twitter_ad_variants']) ? TwitterAdVariants::fromArray($data['twitter_ad_variants']) : null,
            isset($data['google_responsive_ad_variants'])
                ? GoogleResponsiveAdVariants::fromArray($data['google_responsive_ad_variants']) : null
        );
    }

    public function toArray(): array
    {
        return [
            'campaign_images' => $this->campaignImages ? $this->campaignImages->toArray() : null,
            'campaign_videos' => $this->campaignVideos ? $this->campaignVideos->toArray() : null,
            'facebook_ai_multi_ad_variants' => $this->facebookAiMultiAdVariants ? $this->facebookAiMultiAdVariants->toArray() : null,
            'facebook_carousel_variants' => $this->facebookCarouselVariants ? $this->facebookCarouselVariants->toArray() : null,
            'ad_text' => $this->adText ? $this->adText->toArray() : null,
            'linked_in_ad_variants' => $this->linkedInAdVariants ? $this->linkedInAdVariants->toArray() : null,
            'twitter_ad_variants' => $this->twitterAdVariants ? $this->twitterAdVariants->toArray() : null,
            'google_responsive_ad_variants' => $this->googleResponsiveAdVariants ? $this->googleResponsiveAdVariants->toArray() : null,
        ];
    }
}
