<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent;

use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\AdVariant\Facebook\FacebookAdVariants;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\AdVariant\FacebookCarousel\FacebookCarouselVariants;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\AdVariant\Google\GoogleAdVariants;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\AdVariant\Google\GoogleResponsiveAdVariants;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\AdVariant\LinkedIn\LinkedInAdVariants;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\AdVariant\Twitter\TwitterAdVariants;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\CampaignImage\CampaignImages;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\CampaignVideo\CampaignVideos;

class CampaignContent extends AbstractValueObject
{
    /**
     * @var CampaignImages | null
     */
    private $campaignImages;

    /**
     * @var CampaignVideos|null
     */
    private $campaignVideos;

    /**
     * @var FacebookAdVariants | null
     */
    private $facebookAdVariants;

    /**
     * @var FacebookCarouselVariants | null
     */
    private $facebookCarouselVariants;

    /**
     * @var AdText | null
     */
    private $adText;

    /**
     * @var LinkedInAdVariants | null
     */
    private $linkedInAdVariants;

    /**
     * @var GoogleAdVariants | null
     */
    private $googleAdVariants;

    /**
     * @var TwitterAdVariants | null
     */
    private $twitterAdVariants;

    /**
     * @var GoogleResponsiveAdVariants | null
     */
    private $googleResponsiveAdVariants;

    /**
     * CampaignContent constructor.
     */
    public function __construct(
        ?CampaignImages $campaignImages,
        ?CampaignVideos $campaignVideos,
        ?FacebookAdVariants $facebookAdVariants,
        ?FacebookCarouselVariants $facebookCarouselVariants,
        ?AdText $adText,
        ?LinkedInAdVariants $linkedInAdVariants,
        ?GoogleAdVariants $googleAdVariants,
        ?TwitterAdVariants $twitterAdVariants,
        ?GoogleResponsiveAdVariants $googleResponsiveAdVariants
    ) {
        $this->campaignImages = $campaignImages;
        $this->campaignVideos = $campaignVideos;
        $this->facebookAdVariants = $facebookAdVariants;
        $this->facebookCarouselVariants = $facebookCarouselVariants;
        $this->adText = $adText;
        $this->linkedInAdVariants = $linkedInAdVariants;
        $this->googleAdVariants = $googleAdVariants;
        $this->twitterAdVariants = $twitterAdVariants;
        $this->googleResponsiveAdVariants = $googleResponsiveAdVariants;
    }

    /**
     * @return CampaignContent
     */
    public static function fromArray(array $data): self
    {
        return new self(
            isset($data['campaign_images']) ? CampaignImages::fromArray($data['campaign_images']) : null,
            isset($data['campaign_videos']) ? CampaignVideos::fromArray($data['campaign_videos']) : null,
            isset($data['facebook_ad_variants'])
                ? FacebookAdVariants::fromArray($data['facebook_ad_variants']) : null,
            isset($data['facebook_carousel_variants'])
                ? FacebookCarouselVariants::fromArray($data['facebook_carousel_variants']) : null,
            isset($data['ad_text']) ? AdText::fromArray($data['ad_text']) : null,
            isset($data['linked_in_ad_variants'])
                ? LinkedInAdVariants::fromArray($data['linked_in_ad_variants']) : null,
            isset($data['google_ad_variants']) ? GoogleAdVariants::fromArray($data['google_ad_variants']) : null,
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
            'facebook_ad_variants' => $this->facebookAdVariants ? $this->facebookAdVariants->toArray() : null,
            'facebook_carousel_variants' => $this->facebookCarouselVariants
                ? $this->facebookCarouselVariants->toArray() : null,
            'ad_text' => $this->adText ? $this->adText->toArray() : null,
            'linked_in_ad_variants' => $this->linkedInAdVariants ? $this->linkedInAdVariants->toArray() : null,
            'google_ad_variants' => $this->googleAdVariants ? $this->googleAdVariants->toArray() : null,
            'twitter_ad_variants' => $this->twitterAdVariants ? $this->twitterAdVariants->toArray() : null,
            'google_responsive_ad_variants' => $this->googleResponsiveAdVariants
                ? $this->googleResponsiveAdVariants->toArray() : null,
        ];
    }

    public function equals(ValueObjectInterface $other): bool
    {
        if (!$other instanceof self) {
            return false;
        }

        return $this->toArray() === $other->toArray();
    }

    public function __toString(): string
    {
        return (string) json_encode($this->toArray());
    }

    public function campaignImages(): ?CampaignImages
    {
        return $this->campaignImages;
    }

    public function campaignVideos(): ?CampaignVideos
    {
        return $this->campaignVideos;
    }

    public function facebookAdVariants(): ?FacebookAdVariants
    {
        return $this->facebookAdVariants;
    }

    public function facebookCarouselVariants(): ?FacebookCarouselVariants
    {
        return $this->facebookCarouselVariants;
    }

    public function adText(): ?AdText
    {
        return $this->adText;
    }

    public function linkedInAdVariants(): ?LinkedInAdVariants
    {
        return $this->linkedInAdVariants;
    }

    public function googleAdVariants(): ?GoogleAdVariants
    {
        return $this->googleAdVariants;
    }

    public function twitterAdVariants(): ?TwitterAdVariants
    {
        return $this->twitterAdVariants;
    }

    public function googleResponsiveAdVariants(): ?GoogleResponsiveAdVariants
    {
        return $this->googleResponsiveAdVariants;
    }
}
