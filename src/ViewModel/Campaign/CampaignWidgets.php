<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign;

use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\AfterSoldAction;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\CampaignContent;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignPeriod;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignSticker\CampaignStickers;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignTag;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignTitle;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\Comment;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\LandingPage;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\LeadForm;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\LocationTargeting\IndustryAddress;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\LocationTargeting\LocationTargeting;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\Notification\Notifications;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\Options\AdvancedSlideshow;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\Options\CampaignPhase\CampaignPhases;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\Options\FacebookSlideshow;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\Options\LocalBoost;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\Options\NewPrice;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\Options\OpenHouse;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\Options\Options;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\Options\PostFirstVariantToFacebook;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\Product;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\Targeting\Targeting;
use Exception;

final class CampaignWidgets extends AbstractValueObject
{
    /**
     * @var LandingPage | null
     */
    private $landingPage;

    /**
     * @var CampaignPeriod | null
     */
    private $campaignPeriod;

    /**
     * @var PostFirstVariantToFacebook|null
     */
    private $postFirstVariantToFacebook;

    /**
     * @var Comment | null
     */
    private $comment;

    /**
     * @var CampaignTag | null
     */
    private $campaignTag;

    /**
     * @var CampaignTitle | null
     */
    private $campaignTitle;

    /**
     * @var LocalBoost | null
     */
    private $localBoost;

    /**
     * @var LocationTargeting | null
     */
    private $locationTargeting;

    /**
     * @var IndustryAddress | null
     */
    private $industryAddress;

    /**
     * @var Product | null
     */
    private $product;

    /**
     * @var CampaignContent | null
     */
    private $campaignContent;

    /**
     * @var CampaignPhases | null
     */
    private $campaignPhases;

    /**
     * @var OpenHouse | null
     */
    private $openHouse;

    /**
     * @var NewPrice | null
     */
    private $newPrice;

    /**
     * @var LeadForm | null
     */
    private $leadForm;

    /**
     * @var FacebookSlideshow | null
     */
    private $facebookSlideshow;

    /**
     * @var AdvancedSlideshow|null
     */
    private $advancedSlideshow;

    /**
     * @var Targeting|null
     */
    private $targeting;

    /**
     * @var Notifications|null
     */
    private $notifications;

    /**
     * @var AfterSoldAction|null
     */
    private $afterSoldAction;

    /**
     * @var Options|null
     */
    private $options;

    /**
     * @var CampaignStickers | null
     */
    private $campaignStickers;

    /**
     * @throws Exception
     */
    public static function fromArray(array $data): self
    {
        return new self(
            isset($data['targeting']) ? Targeting::fromArray($data['targeting']) : null,
            isset($data['landing_page']) ? LandingPage::fromString($data['landing_page']) : null,
            isset($data['campaign_period']) ? CampaignPeriod::fromArray($data['campaign_period']) : null,
            isset($data['post_first_variant_to_facebook'])
                ? PostFirstVariantToFacebook::fromMixed($data['post_first_variant_to_facebook']) : null,
            isset($data['comment']) ? Comment::fromString($data['comment']) : null,
            isset($data['campaign_tag']) ? CampaignTag::fromString($data['campaign_tag']) : null,
            isset($data['campaign_title']) ? CampaignTitle::fromString($data['campaign_title']) : null,
            isset($data['local_boost']) ? LocalBoost::fromArray($data['local_boost']) : null,
            isset($data['location_targeting']) ? LocationTargeting::fromArray($data['location_targeting']) : null,
            isset($data['industry_address']) ? IndustryAddress::fromArray($data['industry_address']) : null,
            isset($data['product']) ? Product::fromArray($data['product']) : null,
            isset($data['campaign_content'])
                ? CampaignContent::fromArray($data['campaign_content']) : CampaignContent::fromArray($data),
            isset($data['campaign_phases']) ? CampaignPhases::fromArray($data['campaign_phases']) : null,
            isset($data['open_house']) ? OpenHouse::fromArray($data['open_house']) : null,
            isset($data['new_price']) ? NewPrice::fromArray($data['new_price']) : null,
            isset($data['lead_form']) ? LeadForm::fromArray($data['lead_form']) : null,
            isset($data['facebook_slideshow']) ? FacebookSlideshow::fromArray($data['facebook_slideshow']) : null,
            isset($data['advanced_slideshow']) ? AdvancedSlideshow::fromArray($data['advanced_slideshow']) : null,
            isset($data['notifications']) ? Notifications::fromArray($data['notifications']) : null,
            isset($data['after_sold_action']) ? AfterSoldAction::fromArray($data['after_sold_action']) : null,
            isset($data['options']) ? Options::fromArray($data['options']) : null,
            isset($data['campaign_stickers']) ? CampaignStickers::fromArray($data['campaign_stickers']) : null
        );
    }

    /**
     * Creates an empty campaign widget object
     *
     * @return static
     *
     * @throws Exception
     */
    public static function fromEmpty(): self
    {
        return self::fromArray([]);
    }

    /**
     * CampaignWidgets constructor.
     */
    private function __construct(
        ?Targeting $targeting,
        ?LandingPage $landingPage,
        ?CampaignPeriod $campaignPeriod,
        ?PostFirstVariantToFacebook $postFirstVariantToFacebook,
        ?Comment $comment,
        ?CampaignTag $campaignTag,
        ?CampaignTitle $campaignTitle,
        ?LocalBoost $localBoost,
        ?LocationTargeting $locationTargeting,
        ?IndustryAddress $industryAddress,
        ?Product $product,
        ?CampaignContent $campaignContent,
        ?CampaignPhases $campaignPhases,
        ?OpenHouse $openHouse,
        ?NewPrice $newPrice,
        ?LeadForm $leadForm,
        ?FacebookSlideshow $facebookSlideshow,
        ?AdvancedSlideshow $advancedSlideshow,
        ?Notifications $notifications,
        ?AfterSoldAction $afterSoldAction,
        ?Options $options,
        ?CampaignStickers $campaignStickers
    ) {
        $this->targeting = $targeting;
        $this->landingPage = $landingPage;
        $this->campaignPeriod = $campaignPeriod;
        $this->postFirstVariantToFacebook = $postFirstVariantToFacebook;
        $this->comment = $comment;
        $this->campaignTag = $campaignTag;
        $this->campaignTitle = $campaignTitle;
        $this->localBoost = $localBoost;
        $this->locationTargeting = $locationTargeting;
        $this->industryAddress = $industryAddress;
        $this->product = $product;
        $this->campaignContent = $campaignContent;
        $this->campaignPhases = $campaignPhases;
        $this->openHouse = $openHouse;
        $this->newPrice = $newPrice;
        $this->leadForm = $leadForm;
        $this->facebookSlideshow = $facebookSlideshow;
        $this->advancedSlideshow = $advancedSlideshow;
        $this->notifications = $notifications;
        $this->afterSoldAction = $afterSoldAction;
        $this->options = $options;
        $this->campaignStickers = $campaignStickers;
    }

    public function toArray(): array
    {
        return [
            'targeting' => $this->targeting ? $this->targeting->toArray() : null,
            'landing_page' => $this->landingPage ? $this->landingPage->toString() : null,
            'campaign_period' => $this->campaignPeriod ? $this->campaignPeriod->toArray() : null,
            'post_first_variant_to_facebook' => $this->postFirstVariantToFacebook
                ? $this->postFirstVariantToFacebook->toBool() : null,
            'comment' => $this->comment ? $this->comment->toString() : null,
            'campaign_tag' => $this->campaignTag ? $this->campaignTag->toString() : null,
            'campaign_title' => $this->campaignTitle ? $this->campaignTitle->toString() : null,
            'local_boost' => $this->localBoost ? $this->localBoost->toArray() : null,
            'location_targeting' => $this->locationTargeting ? $this->locationTargeting->toArray() : null,
            'industry_address' => $this->industryAddress ? $this->industryAddress->toArray() : null,
            'product' => $this->product ? $this->product->toArray() : null,
            'campaign_content' => $this->campaignContent ? $this->campaignContent->toArray() : null,
            'campaign_phases' => $this->campaignPhases ? $this->campaignPhases->toArray() : null,
            'open_house' => $this->openHouse ? $this->openHouse->toArray() : null,
            'new_price' => $this->newPrice ? $this->newPrice->toArray() : null,
            'lead_form' => $this->leadForm ? $this->leadForm->toArray() : null,
            'facebook_slideshow' => $this->facebookSlideshow ? $this->facebookSlideshow->toArray() : null,
            'advanced_slideshow' => $this->advancedSlideshow ? $this->advancedSlideshow->toArray() : null,
            'notifications' => $this->notifications ? $this->notifications->toArray() : null,
            'after_sold_action' => $this->afterSoldAction ? $this->afterSoldAction->toArray() : null,
            'options' => $this->options ? $this->options->toArray() : null,
            'campaign_stickers' => $this->campaignStickers ? $this->campaignStickers->toArray() : null,
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

    public function landingPage(): ?LandingPage
    {
        return $this->landingPage;
    }

    public function campaignPeriod(): ?CampaignPeriod
    {
        return $this->campaignPeriod;
    }

    public function postFirstVariantToFacebook(): ?PostFirstVariantToFacebook
    {
        return $this->postFirstVariantToFacebook;
    }

    public function comment(): ?Comment
    {
        return $this->comment;
    }

    public function campaignTag(): ?CampaignTag
    {
        return $this->campaignTag;
    }

    public function campaignTitle(): ?CampaignTitle
    {
        return $this->campaignTitle;
    }

    public function localBoost(): ?LocalBoost
    {
        return $this->localBoost;
    }

    public function locationTargeting(): ?LocationTargeting
    {
        return $this->locationTargeting;
    }

    public function industryAddress(): ?IndustryAddress
    {
        return $this->industryAddress;
    }

    public function product(): ?Product
    {
        return $this->product;
    }

    public function campaignContent(): ?CampaignContent
    {
        return $this->campaignContent;
    }

    public function campaignPhases(): ?CampaignPhases
    {
        return $this->campaignPhases;
    }

    public function openHouse(): ?OpenHouse
    {
        return $this->openHouse;
    }

    public function newPrice(): ?NewPrice
    {
        return $this->newPrice;
    }

    public function leadForm(): ?LeadForm
    {
        return $this->leadForm;
    }

    public function facebookSlideshow(): ?FacebookSlideshow
    {
        return $this->facebookSlideshow;
    }

    public function advancedSlideshow(): ?AdvancedSlideshow
    {
        return $this->advancedSlideshow;
    }

    public function updateLocationTargeting(LocationTargeting $locationTargeting)
    {
        $this->locationTargeting = $locationTargeting;
    }

    public function updateIndustryAddress(IndustryAddress $industryAddress)
    {
        $this->industryAddress = $industryAddress;
    }

    public function targeting(): ?Targeting
    {
        return $this->targeting;
    }

    public function notifications(): ?Notifications
    {
        return $this->notifications;
    }

    public function afterSoldAction(): ?AfterSoldAction
    {
        return $this->afterSoldAction;
    }

    public function options(): ?Options
    {
        return $this->options;
    }

    public function campaignStickers(): ?CampaignStickers
    {
        return $this->campaignStickers;
    }
}
