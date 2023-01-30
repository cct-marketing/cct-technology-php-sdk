<?php

declare(strict_types=1);

namespace CCT\SDK\Infrastructure\Serialization\Mapper;

use EventSauce\ObjectHydrator\IterableList;
use EventSauce\ObjectHydrator\ObjectMapper;
use EventSauce\ObjectHydrator\UnableToHydrateObject;
use EventSauce\ObjectHydrator\UnableToSerializeObject;
use Generator;

/**
 * @template T
 */
class OptimizedMapper implements ObjectMapper
{
    private array $hydrationStack = [];
    public function __construct() {}

    /**
     * @param class-string<T> $className
     * @return T
     */
    public function hydrateObject(string $className, array $payload): object
    {
        return match($className) {
            'CCT\SDK\Analytics\Response\Analytics' => $this->hydrateCCTSDKAnalyticsResponseAnalytics($payload),
                'CCT\SDK\Analytics\Response\Analytics\Clicks' => $this->hydrateCCTSDKAnalyticsResponseAnalyticsClicks($payload),
                'CCT\SDK\Analytics\Response\Analytics\Facebook' => $this->hydrateCCTSDKAnalyticsResponseAnalyticsFacebook($payload),
                'CCT\SDK\Analytics\Response\Analytics\Impressions' => $this->hydrateCCTSDKAnalyticsResponseAnalyticsImpressions($payload),
                'CCT\SDK\Analytics\Response\Analytics\Reach' => $this->hydrateCCTSDKAnalyticsResponseAnalyticsReach($payload),
                'CCT\SDK\Analytics\Response\Analytics\Readers' => $this->hydrateCCTSDKAnalyticsResponseAnalyticsReaders($payload),
                'CCT\SDK\Analytics\Response\Analytics\Target' => $this->hydrateCCTSDKAnalyticsResponseAnalyticsTarget($payload),
                'CCT\SDK\Analytics\Response\CampaignAnalytics' => $this->hydrateCCTSDKAnalyticsResponseCampaignAnalytics($payload),
                'CCT\SDK\Analytics\Response\Customer' => $this->hydrateCCTSDKAnalyticsResponseCustomer($payload),
                'CCT\SDK\Analytics\Response\Period' => $this->hydrateCCTSDKAnalyticsResponsePeriod($payload),
                'CCT\SDK\CampaignFlow\Data\CampaignFlowId' => $this->hydrateCCTSDKCampaignFlowDataCampaignFlowId($payload),
                'CCT\SDK\CampaignFlow\Data\Currency' => $this->hydrateCCTSDKCampaignFlowDataCurrency($payload),
                'CCT\SDK\CampaignFlow\Data\ExcludeVat' => $this->hydrateCCTSDKCampaignFlowDataExcludeVat($payload),
                'CCT\SDK\CampaignFlow\Data\Pricing' => $this->hydrateCCTSDKCampaignFlowDataPricing($payload),
                'CCT\SDK\CampaignFlow\Data\PricingItem' => $this->hydrateCCTSDKCampaignFlowDataPricingItem($payload),
                'CCT\SDK\CampaignFlow\Data\Settings' => $this->hydrateCCTSDKCampaignFlowDataSettings($payload),
                'CCT\SDK\CampaignFlow\Data\Vat' => $this->hydrateCCTSDKCampaignFlowDataVat($payload),
                'CCT\SDK\CampaignFlow\Response\CampaignFlowItem' => $this->hydrateCCTSDKCampaignFlowResponseCampaignFlowItem($payload),
                'CCT\SDK\CampaignFlow\Response\ListResponse' => $this->hydrateCCTSDKCampaignFlowResponseListResponse($payload),
                'CCT\SDK\Campaign\Data\AdContent\AdContent' => $this->hydrateCCTSDKCampaignDataAdContentAdContent($payload),
                'CCT\SDK\Campaign\Data\AdContent\AdText' => $this->hydrateCCTSDKCampaignDataAdContentAdText($payload),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel\FacebookCarouselCard' => $this->hydrateCCTSDKCampaignDataAdContentAdVariantFacebookCarouselFacebookCarouselCard($payload),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel\FacebookCarouselCardCollection' => $this->hydrateCCTSDKCampaignDataAdContentAdVariantFacebookCarouselFacebookCarouselCardCollection($payload),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel\FacebookCarouselVariant' => $this->hydrateCCTSDKCampaignDataAdContentAdVariantFacebookCarouselFacebookCarouselVariant($payload),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel\FacebookCarouselVariants' => $this->hydrateCCTSDKCampaignDataAdContentAdVariantFacebookCarouselFacebookCarouselVariants($payload),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\Description' => $this->hydrateCCTSDKCampaignDataAdContentAdVariantFacebookAiMultiVariantPartDescription($payload),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\DescriptionCollection' => $this->hydrateCCTSDKCampaignDataAdContentAdVariantFacebookAiMultiVariantPartDescriptionCollection($payload),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\Heading' => $this->hydrateCCTSDKCampaignDataAdContentAdVariantFacebookAiMultiVariantPartHeading($payload),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\HeadingCollection' => $this->hydrateCCTSDKCampaignDataAdContentAdVariantFacebookAiMultiVariantPartHeadingCollection($payload),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\Text' => $this->hydrateCCTSDKCampaignDataAdContentAdVariantFacebookAiMultiVariantPartText($payload),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\TextCollection' => $this->hydrateCCTSDKCampaignDataAdContentAdVariantFacebookAiMultiVariantPartTextCollection($payload),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\FacebookAiMultiAdVariant' => $this->hydrateCCTSDKCampaignDataAdContentAdVariantFacebookFacebookAiMultiAdVariant($payload),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\FacebookAiMultiAdVariants' => $this->hydrateCCTSDKCampaignDataAdContentAdVariantFacebookFacebookAiMultiAdVariants($payload),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleAdVariant' => $this->hydrateCCTSDKCampaignDataAdContentAdVariantGoogleGoogleAdVariant($payload),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleAdVariants' => $this->hydrateCCTSDKCampaignDataAdContentAdVariantGoogleGoogleAdVariants($payload),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleResponsiveAdVariant' => $this->hydrateCCTSDKCampaignDataAdContentAdVariantGoogleGoogleResponsiveAdVariant($payload),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleResponsiveAdVariants' => $this->hydrateCCTSDKCampaignDataAdContentAdVariantGoogleGoogleResponsiveAdVariants($payload),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\Description' => $this->hydrateCCTSDKCampaignDataAdContentAdVariantGoogleResponsiveAdDescription($payload),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\DescriptionCollection' => $this->hydrateCCTSDKCampaignDataAdContentAdVariantGoogleResponsiveAdDescriptionCollection($payload),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\LongHeadline' => $this->hydrateCCTSDKCampaignDataAdContentAdVariantGoogleResponsiveAdLongHeadline($payload),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\ShortHeadline' => $this->hydrateCCTSDKCampaignDataAdContentAdVariantGoogleResponsiveAdShortHeadline($payload),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\ShortHeadlineCollection' => $this->hydrateCCTSDKCampaignDataAdContentAdVariantGoogleResponsiveAdShortHeadlineCollection($payload),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\LinkedIn\LinkedInAdVariant' => $this->hydrateCCTSDKCampaignDataAdContentAdVariantLinkedInLinkedInAdVariant($payload),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\LinkedIn\LinkedInAdVariants' => $this->hydrateCCTSDKCampaignDataAdContentAdVariantLinkedInLinkedInAdVariants($payload),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Twitter\TwitterAdVariant' => $this->hydrateCCTSDKCampaignDataAdContentAdVariantTwitterTwitterAdVariant($payload),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Twitter\TwitterAdVariants' => $this->hydrateCCTSDKCampaignDataAdContentAdVariantTwitterTwitterAdVariants($payload),
                'CCT\SDK\Campaign\Data\AdContent\CampaignImage\CampaignImages' => $this->hydrateCCTSDKCampaignDataAdContentCampaignImageCampaignImages($payload),
                'CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\AbstractChannelImages' => $this->hydrateCCTSDKCampaignDataAdContentCampaignImageChannelImageAbstractChannelImages($payload),
                'CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\ChannelCollection' => $this->hydrateCCTSDKCampaignDataAdContentCampaignImageChannelImageChannelCollection($payload),
                'CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\FacebookImages' => $this->hydrateCCTSDKCampaignDataAdContentCampaignImageChannelImageFacebookImages($payload),
                'CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\GeneralImages' => $this->hydrateCCTSDKCampaignDataAdContentCampaignImageChannelImageGeneralImages($payload),
                'CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\GoogleImages' => $this->hydrateCCTSDKCampaignDataAdContentCampaignImageChannelImageGoogleImages($payload),
                'CCT\SDK\Campaign\Data\AdContent\CampaignVideo\CampaignVideos' => $this->hydrateCCTSDKCampaignDataAdContentCampaignVideoCampaignVideos($payload),
                'CCT\SDK\Campaign\Data\AdContent\Image\Image' => $this->hydrateCCTSDKCampaignDataAdContentImageImage($payload),
                'CCT\SDK\Campaign\Data\AdContent\Image\ImageCollection' => $this->hydrateCCTSDKCampaignDataAdContentImageImageCollection($payload),
                'CCT\SDK\Campaign\Data\AdContent\Image\ImageId' => $this->hydrateCCTSDKCampaignDataAdContentImageImageId($payload),
                'CCT\SDK\Campaign\Data\AdContent\UserSelected' => $this->hydrateCCTSDKCampaignDataAdContentUserSelected($payload),
                'CCT\SDK\Campaign\Data\AdContent\Video\Video' => $this->hydrateCCTSDKCampaignDataAdContentVideoVideo($payload),
                'CCT\SDK\Campaign\Data\AdContent\Video\VideoCollection' => $this->hydrateCCTSDKCampaignDataAdContentVideoVideoCollection($payload),
                'CCT\SDK\Campaign\Data\AdContent\Video\VideoId' => $this->hydrateCCTSDKCampaignDataAdContentVideoVideoId($payload),
                'CCT\SDK\Campaign\Data\CampaignId' => $this->hydrateCCTSDKCampaignDataCampaignId($payload),
                'CCT\SDK\Campaign\Data\Details\CampaignPeriod' => $this->hydrateCCTSDKCampaignDataDetailsCampaignPeriod($payload),
                'CCT\SDK\Campaign\Data\Details\CampaignTitle' => $this->hydrateCCTSDKCampaignDataDetailsCampaignTitle($payload),
                'CCT\SDK\Campaign\Data\Details\Details' => $this->hydrateCCTSDKCampaignDataDetailsDetails($payload),
                'CCT\SDK\Campaign\Data\Details\LandingPage' => $this->hydrateCCTSDKCampaignDataDetailsLandingPage($payload),
                'CCT\SDK\Campaign\Data\Options\AdvancedSlideshow' => $this->hydrateCCTSDKCampaignDataOptionsAdvancedSlideshow($payload),
                'CCT\SDK\Campaign\Data\Options\AfterSoldAction' => $this->hydrateCCTSDKCampaignDataOptionsAfterSoldAction($payload),
                'CCT\SDK\Campaign\Data\Options\FacebookSlideshow' => $this->hydrateCCTSDKCampaignDataOptionsFacebookSlideshow($payload),
                'CCT\SDK\Campaign\Data\Options\LocalBoost' => $this->hydrateCCTSDKCampaignDataOptionsLocalBoost($payload),
                'CCT\SDK\Campaign\Data\Options\NewPrice' => $this->hydrateCCTSDKCampaignDataOptionsNewPrice($payload),
                'CCT\SDK\Campaign\Data\Options\Options' => $this->hydrateCCTSDKCampaignDataOptionsOptions($payload),
                'CCT\SDK\Campaign\Data\Options\PostFirstVariantToFacebook' => $this->hydrateCCTSDKCampaignDataOptionsPostFirstVariantToFacebook($payload),
                'CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Address' => $this->hydrateCCTSDKCampaignDataTargetingLocationTargetingAddress($payload),
                'CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Coordinate' => $this->hydrateCCTSDKCampaignDataTargetingLocationTargetingCoordinate($payload),
                'CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Country' => $this->hydrateCCTSDKCampaignDataTargetingLocationTargetingCountry($payload),
                'CCT\SDK\Campaign\Data\Targeting\LocationTargeting\IndustryAddress' => $this->hydrateCCTSDKCampaignDataTargetingLocationTargetingIndustryAddress($payload),
                'CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Location' => $this->hydrateCCTSDKCampaignDataTargetingLocationTargetingLocation($payload),
                'CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Locations' => $this->hydrateCCTSDKCampaignDataTargetingLocationTargetingLocations($payload),
                'CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Radius' => $this->hydrateCCTSDKCampaignDataTargetingLocationTargetingRadius($payload),
                'CCT\SDK\Campaign\Data\Targeting\PropertyInformation\NumberOfBedrooms' => $this->hydrateCCTSDKCampaignDataTargetingPropertyInformationNumberOfBedrooms($payload),
                'CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertyInformation' => $this->hydrateCCTSDKCampaignDataTargetingPropertyInformationPropertyInformation($payload),
                'CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertyPrice' => $this->hydrateCCTSDKCampaignDataTargetingPropertyInformationPropertyPrice($payload),
                'CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertySize' => $this->hydrateCCTSDKCampaignDataTargetingPropertyInformationPropertySize($payload),
                'CCT\SDK\Campaign\Data\Targeting\Targeting' => $this->hydrateCCTSDKCampaignDataTargetingTargeting($payload),
                'CCT\SDK\Campaign\Payload\CreateCampaign' => $this->hydrateCCTSDKCampaignPayloadCreateCampaign($payload),
                'CCT\SDK\Campaign\Payload\SaveCampaign' => $this->hydrateCCTSDKCampaignPayloadSaveCampaign($payload),
                'CCT\SDK\Campaign\Payload\StartCampaign' => $this->hydrateCCTSDKCampaignPayloadStartCampaign($payload),
                'CCT\SDK\Campaign\Response\CommonMutateResponse' => $this->hydrateCCTSDKCampaignResponseCommonMutateResponse($payload),
                'CCT\SDK\Customer\Data\AgencyId' => $this->hydrateCCTSDKCustomerDataAgencyId($payload),
                'CCT\SDK\Customer\Data\CustomerId' => $this->hydrateCCTSDKCustomerDataCustomerId($payload),
                'CCT\SDK\Customer\Data\Name' => $this->hydrateCCTSDKCustomerDataName($payload),
                'CCT\SDK\Customer\Response\ListResult' => $this->hydrateCCTSDKCustomerResponseListResult($payload),
                'CCT\SDK\Customer\Response\List\Agency' => $this->hydrateCCTSDKCustomerResponseListAgency($payload),
                'CCT\SDK\Customer\Response\List\Customer' => $this->hydrateCCTSDKCustomerResponseListCustomer($payload),
                'CCT\SDK\Customer\Response\List\Customers' => $this->hydrateCCTSDKCustomerResponseListCustomers($payload),
                'CCT\SDK\MediaManagement\Request\Context\Context' => $this->hydrateCCTSDKMediaManagementRequestContextContext($payload),
                'CCT\SDK\MediaManagement\Request\Media\BaseMediaCreate' => $this->hydrateCCTSDKMediaManagementRequestMediaBaseMediaCreate($payload),
                'CCT\SDK\MediaManagement\Request\Media\CreateMediaCollection' => $this->hydrateCCTSDKMediaManagementRequestMediaCreateMediaCollection($payload),
                'CCT\SDK\MediaManagement\Request\Media\ExternalMedia' => $this->hydrateCCTSDKMediaManagementRequestMediaExternalMedia($payload),
                'CCT\SDK\MediaManagement\Request\Media\MediaId' => $this->hydrateCCTSDKMediaManagementRequestMediaMediaId($payload),
                'CCT\SDK\MediaManagement\Request\Media\MediaIdCollection' => $this->hydrateCCTSDKMediaManagementRequestMediaMediaIdCollection($payload),
                'CCT\SDK\MediaManagement\Request\Media\MediaTypeCollection' => $this->hydrateCCTSDKMediaManagementRequestMediaMediaTypeCollection($payload),
                'CCT\SDK\MediaManagement\Request\Media\RemoteMedia' => $this->hydrateCCTSDKMediaManagementRequestMediaRemoteMedia($payload),
                'CCT\SDK\MediaManagement\Request\Media\StatusCollection' => $this->hydrateCCTSDKMediaManagementRequestMediaStatusCollection($payload),
                'CCT\SDK\MediaManagement\Request\Media\UploadMedia' => $this->hydrateCCTSDKMediaManagementRequestMediaUploadMedia($payload),
                'CCT\SDK\MediaManagement\Request\SearchQueryParams' => $this->hydrateCCTSDKMediaManagementRequestSearchQueryParams($payload),
                'CCT\SDK\MediaManagement\ViewModel\BaseMedia' => $this->hydrateCCTSDKMediaManagementViewModelBaseMedia($payload),
                'CCT\SDK\MediaManagement\ViewModel\Context' => $this->hydrateCCTSDKMediaManagementViewModelContext($payload),
                'CCT\SDK\MediaManagement\ViewModel\ContextCollection' => $this->hydrateCCTSDKMediaManagementViewModelContextCollection($payload),
                'CCT\SDK\MediaManagement\ViewModel\MediaAudio' => $this->hydrateCCTSDKMediaManagementViewModelMediaAudio($payload),
                'CCT\SDK\MediaManagement\ViewModel\MediaCollection' => $this->hydrateCCTSDKMediaManagementViewModelMediaCollection($payload),
                'CCT\SDK\MediaManagement\ViewModel\MediaDocument' => $this->hydrateCCTSDKMediaManagementViewModelMediaDocument($payload),
                'CCT\SDK\MediaManagement\ViewModel\MediaImage' => $this->hydrateCCTSDKMediaManagementViewModelMediaImage($payload),
                'CCT\SDK\MediaManagement\ViewModel\MediaVideo' => $this->hydrateCCTSDKMediaManagementViewModelMediaVideo($payload),
                'CCT\SDK\MediaManagement\ViewModel\SearchResult' => $this->hydrateCCTSDKMediaManagementViewModelSearchResult($payload),
                'CCT\SDK\Infrastructure\ValueObject\Enabled' => $this->hydrateCCTSDKInfrastructureValueObjectEnabled($payload),
                'CCT\SDK\Infrastructure\ValueObject\Uri' => $this->hydrateCCTSDKInfrastructureValueObjectUri($payload),
            default => throw UnableToHydrateObject::noHydrationDefined($className, $this->hydrationStack),
        };
    }
    
            
        private function hydrateCCTSDKAnalyticsResponseAnalytics(array $payload): \CCT\SDK\Analytics\Response\Analytics
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['clicks'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'clicks';
                    goto after_clicks;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'clicks';
                        $value = $this->hydrateCCTSDKAnalyticsResponseAnalyticsClicks($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['clicks'] = $value;
    
                after_clicks:

                $value = $payload['facebook'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'facebook';
                    goto after_facebook;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'facebook';
                        $value = $this->hydrateCCTSDKAnalyticsResponseAnalyticsFacebook($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['facebook'] = $value;
    
                after_facebook:

                $value = $payload['impressions'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'impressions';
                    goto after_impressions;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'impressions';
                        $value = $this->hydrateCCTSDKAnalyticsResponseAnalyticsImpressions($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['impressions'] = $value;
    
                after_impressions:

                $value = $payload['reach'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'reach';
                    goto after_reach;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'reach';
                        $value = $this->hydrateCCTSDKAnalyticsResponseAnalyticsReach($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['reach'] = $value;
    
                after_reach:

                $value = $payload['readers'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'readers';
                    goto after_readers;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'readers';
                        $value = $this->hydrateCCTSDKAnalyticsResponseAnalyticsReaders($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['readers'] = $value;
    
                after_readers:

                $value = $payload['target'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'target';
                    goto after_target;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'target';
                        $value = $this->hydrateCCTSDKAnalyticsResponseAnalyticsTarget($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['target'] = $value;
    
                after_target:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Analytics\Response\Analytics', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Analytics\Response\Analytics::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Analytics\Response\Analytics(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Analytics\Response\Analytics', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKAnalyticsResponseAnalyticsClicks(array $payload): \CCT\SDK\Analytics\Response\Analytics\Clicks
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['clicks'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'clicks';
                    goto after_clicks;
                }

                $properties['clicks'] = $value;
    
                after_clicks:

                $value = $payload['clicks_per_day'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'clicks_per_day';
                    goto after_clicksPerDay;
                }

                $properties['clicksPerDay'] = $value;
    
                after_clicksPerDay:

                $value = $payload['clicks_per_channel'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'clicks_per_channel';
                    goto after_clicksPerChannel;
                }

                $properties['clicksPerChannel'] = $value;
    
                after_clicksPerChannel:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Analytics\Response\Analytics\Clicks', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Analytics\Response\Analytics\Clicks::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Analytics\Response\Analytics\Clicks(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Analytics\Response\Analytics\Clicks', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKAnalyticsResponseAnalyticsFacebook(array $payload): \CCT\SDK\Analytics\Response\Analytics\Facebook
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['likes_shares'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'likes_shares';
                    goto after_likesShares;
                }

                $properties['likesShares'] = $value;
    
                after_likesShares:

                $value = $payload['fb_likes'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'fb_likes';
                    goto after_fbLikes;
                }

                $properties['fbLikes'] = $value;
    
                after_fbLikes:

                $value = $payload['fb_shares'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'fb_shares';
                    goto after_fbShares;
                }

                $properties['fbShares'] = $value;
    
                after_fbShares:

                $value = $payload['fb_comments'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'fb_comments';
                    goto after_fbComments;
                }

                $properties['fbComments'] = $value;
    
                after_fbComments:

                $value = $payload['fb_gender_age_range'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'fb_gender_age_range';
                    goto after_fbGenderAgeRange;
                }

                $properties['fbGenderAgeRange'] = $value;
    
                after_fbGenderAgeRange:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Analytics\Response\Analytics\Facebook', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Analytics\Response\Analytics\Facebook::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Analytics\Response\Analytics\Facebook(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Analytics\Response\Analytics\Facebook', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKAnalyticsResponseAnalyticsImpressions(array $payload): \CCT\SDK\Analytics\Response\Analytics\Impressions
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['impressions'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'impressions';
                    goto after_impressions;
                }

                $properties['impressions'] = $value;
    
                after_impressions:

                $value = $payload['impressions_ctr'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'impressions_ctr';
                    goto after_impressionsCtr;
                }

                $properties['impressionsCtr'] = $value;
    
                after_impressionsCtr:

                $value = $payload['impressions_by_channel'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'impressions_by_channel';
                    goto after_impressionsByChannel;
                }

                $properties['impressionsByChannel'] = $value;
    
                after_impressionsByChannel:

                $value = $payload['impressions_per_day'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'impressions_per_day';
                    goto after_impressionsPerDay;
                }

                $properties['impressionsPerDay'] = $value;
    
                after_impressionsPerDay:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Analytics\Response\Analytics\Impressions', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Analytics\Response\Analytics\Impressions::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Analytics\Response\Analytics\Impressions(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Analytics\Response\Analytics\Impressions', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKAnalyticsResponseAnalyticsReach(array $payload): \CCT\SDK\Analytics\Response\Analytics\Reach
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['reach'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'reach';
                    goto after_reach;
                }

                $properties['reach'] = $value;
    
                after_reach:

                $value = $payload['reach_ctr'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'reach_ctr';
                    goto after_reachCtr;
                }

                $properties['reachCtr'] = $value;
    
                after_reachCtr:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Analytics\Response\Analytics\Reach', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Analytics\Response\Analytics\Reach::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Analytics\Response\Analytics\Reach(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Analytics\Response\Analytics\Reach', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKAnalyticsResponseAnalyticsReaders(array $payload): \CCT\SDK\Analytics\Response\Analytics\Readers
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['readers'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'readers';
                    goto after_readers;
                }

                $properties['readers'] = $value;
    
                after_readers:

                $value = $payload['cct_readers'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'cct_readers';
                    goto after_cctReaders;
                }

                $properties['cctReaders'] = $value;
    
                after_cctReaders:

                $value = $payload['other_readers'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'other_readers';
                    goto after_otherReaders;
                }

                $properties['otherReaders'] = $value;
    
                after_otherReaders:

                $value = $payload['total_readers'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'total_readers';
                    goto after_totalReaders;
                }

                $properties['totalReaders'] = $value;
    
                after_totalReaders:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Analytics\Response\Analytics\Readers', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Analytics\Response\Analytics\Readers::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Analytics\Response\Analytics\Readers(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Analytics\Response\Analytics\Readers', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKAnalyticsResponseAnalyticsTarget(array $payload): \CCT\SDK\Analytics\Response\Analytics\Target
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['target_group_size'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'target_group_size';
                    goto after_targetGroupSize;
                }

                $properties['targetGroupSize'] = $value;
    
                after_targetGroupSize:

                $value = $payload['average_time'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'average_time';
                    goto after_averageTime;
                }

                $properties['averageTime'] = $value;
    
                after_averageTime:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Analytics\Response\Analytics\Target', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Analytics\Response\Analytics\Target::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Analytics\Response\Analytics\Target(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Analytics\Response\Analytics\Target', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKAnalyticsResponseCampaignAnalytics(array $payload): \CCT\SDK\Analytics\Response\CampaignAnalytics
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['campaign_id'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'campaign_id';
                    goto after_campaignId;
                }

                static $campaignIdCaster1;
    
                if ($campaignIdCaster1 === null) {
                    $campaignIdCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\CampaignId',
));
                }
    
                $value = $campaignIdCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'campaignId';
                        $value = $this->hydrateCCTSDKCampaignDataCampaignId($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['campaignId'] = $value;
    
                after_campaignId:

                $value = $payload['order_code'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'order_code';
                    goto after_orderCode;
                }

                $properties['orderCode'] = $value;
    
                after_orderCode:

                $value = $payload['order_type'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'order_type';
                    goto after_orderType;
                }

                $properties['orderType'] = $value;
    
                after_orderType:

                $value = $payload['customer'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'customer';
                    goto after_customer;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'customer';
                        $value = $this->hydrateCCTSDKAnalyticsResponseCustomer($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['customer'] = $value;
    
                after_customer:

                $value = $payload['analytics'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'analytics';
                    goto after_analytics;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'analytics';
                        $value = $this->hydrateCCTSDKAnalyticsResponseAnalytics($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['analytics'] = $value;
    
                after_analytics:

                $value = $payload['period'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'period';
                    goto after_period;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'period';
                        $value = $this->hydrateCCTSDKAnalyticsResponsePeriod($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['period'] = $value;
    
                after_period:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Analytics\Response\CampaignAnalytics', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Analytics\Response\CampaignAnalytics::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Analytics\Response\CampaignAnalytics(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Analytics\Response\CampaignAnalytics', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKAnalyticsResponseCustomer(array $payload): \CCT\SDK\Analytics\Response\Customer
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['id'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'id';
                    goto after_id;
                }

                static $idCaster1;
    
                if ($idCaster1 === null) {
                    $idCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Customer\\Data\\CustomerId',
));
                }
    
                $value = $idCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'id';
                        $value = $this->hydrateCCTSDKCustomerDataCustomerId($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['id'] = $value;
    
                after_id:

                $value = $payload['agency_id'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'agency_id';
                    goto after_agencyId;
                }

                static $agencyIdCaster1;
    
                if ($agencyIdCaster1 === null) {
                    $agencyIdCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Customer\\Data\\AgencyId',
));
                }
    
                $value = $agencyIdCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'agencyId';
                        $value = $this->hydrateCCTSDKCustomerDataAgencyId($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['agencyId'] = $value;
    
                after_agencyId:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Analytics\Response\Customer', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Analytics\Response\Customer::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Analytics\Response\Customer(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Analytics\Response\Customer', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKAnalyticsResponsePeriod(array $payload): \CCT\SDK\Analytics\Response\Period
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['start_date'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'start_date';
                    goto after_startDate;
                }

                static $startDateCaster1;
    
                if ($startDateCaster1 === null) {
                    $startDateCaster1 = new \EventSauce\ObjectHydrator\PropertyCasters\CastToDateTimeImmutable(...array (
));
                }
    
                $value = $startDateCaster1->cast($value, $this);

                $properties['startDate'] = $value;
    
                after_startDate:

                $value = $payload['end_date'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'end_date';
                    goto after_endDate;
                }

                static $endDateCaster1;
    
                if ($endDateCaster1 === null) {
                    $endDateCaster1 = new \EventSauce\ObjectHydrator\PropertyCasters\CastToDateTimeImmutable(...array (
));
                }
    
                $value = $endDateCaster1->cast($value, $this);

                $properties['endDate'] = $value;
    
                after_endDate:

                $value = $payload['created_at'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'created_at';
                    goto after_createdAt;
                }

                static $createdAtCaster1;
    
                if ($createdAtCaster1 === null) {
                    $createdAtCaster1 = new \EventSauce\ObjectHydrator\PropertyCasters\CastToDateTimeImmutable(...array (
));
                }
    
                $value = $createdAtCaster1->cast($value, $this);

                $properties['createdAt'] = $value;
    
                after_createdAt:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Analytics\Response\Period', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Analytics\Response\Period::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Analytics\Response\Period(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Analytics\Response\Period', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignFlowDataCampaignFlowId(array $payload): \CCT\SDK\CampaignFlow\Data\CampaignFlowId
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['value'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'value';
                    goto after_value;
                }

                static $valueCaster1;
    
                if ($valueCaster1 === null) {
                    $valueCaster1 = new \EventSauce\ObjectHydrator\PropertyCasters\CastToUuid(...array (
));
                }
    
                $value = $valueCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'value';
                        $value = $this->hydrateRamseyUuidUuidInterface($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['value'] = $value;
    
                after_value:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\CampaignFlow\Data\CampaignFlowId', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\CampaignFlow\Data\CampaignFlowId::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\CampaignFlow\Data\CampaignFlowId(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\CampaignFlow\Data\CampaignFlowId', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignFlowDataCurrency(array $payload): \CCT\SDK\CampaignFlow\Data\Currency
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['value'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'value';
                    goto after_value;
                }

                $properties['value'] = $value;
    
                after_value:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\CampaignFlow\Data\Currency', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\CampaignFlow\Data\Currency::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\CampaignFlow\Data\Currency(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\CampaignFlow\Data\Currency', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignFlowDataExcludeVat(array $payload): \CCT\SDK\CampaignFlow\Data\ExcludeVat
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['enabled'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'enabled';
                    goto after_enabled;
                }

                static $enabledCaster1;
    
                if ($enabledCaster1 === null) {
                    $enabledCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Infrastructure\\ValueObject\\Enabled',
));
                }
    
                $value = $enabledCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'enabled';
                        $value = $this->hydrateCCTSDKInfrastructureValueObjectEnabled($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['enabled'] = $value;
    
                after_enabled:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\CampaignFlow\Data\ExcludeVat', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\CampaignFlow\Data\ExcludeVat::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\CampaignFlow\Data\ExcludeVat(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\CampaignFlow\Data\ExcludeVat', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignFlowDataPricing(array $payload): \CCT\SDK\CampaignFlow\Data\Pricing
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['items'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'items';
                    goto after_items;
                }

                if (is_array($value[array_key_first($value)] ?? false)) {
                    try {
                        $this->hydrationStack[] = 'items';
                        $value = $this->hydrateObjects('CCT\SDK\CampaignFlow\Data\PricingItem', $value)->toArray();
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['items'] = $value;
    
                after_items:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\CampaignFlow\Data\Pricing', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\CampaignFlow\Data\Pricing::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\CampaignFlow\Data\Pricing(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\CampaignFlow\Data\Pricing', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignFlowDataPricingItem(array $payload): \CCT\SDK\CampaignFlow\Data\PricingItem
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['type'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'type';
                    goto after_type;
                }

                $value = \CCT\SDK\CampaignFlow\Data\PricingType::from($value);

                $properties['type'] = $value;
    
                after_type:

                $value = $payload['price'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'price';
                    goto after_price;
                }

                $properties['price'] = $value;
    
                after_price:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\CampaignFlow\Data\PricingItem', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\CampaignFlow\Data\PricingItem::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\CampaignFlow\Data\PricingItem(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\CampaignFlow\Data\PricingItem', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignFlowDataSettings(array $payload): \CCT\SDK\CampaignFlow\Data\Settings
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['currency'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'currency';
                    goto after_currency;
                }

                static $currencyCaster1;
    
                if ($currencyCaster1 === null) {
                    $currencyCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\CampaignFlow\\Data\\Currency',
));
                }
    
                $value = $currencyCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'currency';
                        $value = $this->hydrateCCTSDKCampaignFlowDataCurrency($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['currency'] = $value;
    
                after_currency:

                $value = $payload['vat'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'vat';
                    goto after_vat;
                }

                static $vatCaster1;
    
                if ($vatCaster1 === null) {
                    $vatCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\CampaignFlow\\Data\\Vat',
));
                }
    
                $value = $vatCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'vat';
                        $value = $this->hydrateCCTSDKCampaignFlowDataVat($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['vat'] = $value;
    
                after_vat:

                $value = $payload['exclude_vat'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'exclude_vat';
                    goto after_excludeVat;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'excludeVat';
                        $value = $this->hydrateCCTSDKCampaignFlowDataExcludeVat($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['excludeVat'] = $value;
    
                after_excludeVat:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\CampaignFlow\Data\Settings', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\CampaignFlow\Data\Settings::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\CampaignFlow\Data\Settings(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\CampaignFlow\Data\Settings', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignFlowDataVat(array $payload): \CCT\SDK\CampaignFlow\Data\Vat
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['value'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'value';
                    goto after_value;
                }

                $properties['value'] = $value;
    
                after_value:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\CampaignFlow\Data\Vat', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\CampaignFlow\Data\Vat::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\CampaignFlow\Data\Vat(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\CampaignFlow\Data\Vat', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignFlowResponseCampaignFlowItem(array $payload): \CCT\SDK\CampaignFlow\Response\CampaignFlowItem
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['id'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'id';
                    goto after_id;
                }

                static $idCaster1;
    
                if ($idCaster1 === null) {
                    $idCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\CampaignFlow\\Data\\CampaignFlowId',
));
                }
    
                $value = $idCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'id';
                        $value = $this->hydrateCCTSDKCampaignFlowDataCampaignFlowId($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['id'] = $value;
    
                after_id:

                $value = $payload['name'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'name';
                    goto after_name;
                }

                $properties['name'] = $value;
    
                after_name:

                $value = $payload['label'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'label';
                    goto after_label;
                }

                $properties['label'] = $value;
    
                after_label:

                $value = $payload['pricing'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'pricing';
                    goto after_pricing;
                }

                static $pricingCaster1;
    
                if ($pricingCaster1 === null) {
                    $pricingCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\CampaignFlow\\Data\\Pricing',
));
                }
    
                $value = $pricingCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'pricing';
                        $value = $this->hydrateCCTSDKCampaignFlowDataPricing($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['pricing'] = $value;
    
                after_pricing:

                $value = $payload['category'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'category';
                    goto after_category;
                }

                $value = \CCT\SDK\CampaignFlow\Data\Category::from($value);

                $properties['category'] = $value;
    
                after_category:

                $value = $payload['settings'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'settings';
                    goto after_settings;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'settings';
                        $value = $this->hydrateCCTSDKCampaignFlowDataSettings($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['settings'] = $value;
    
                after_settings:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\CampaignFlow\Response\CampaignFlowItem', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\CampaignFlow\Response\CampaignFlowItem::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\CampaignFlow\Response\CampaignFlowItem(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\CampaignFlow\Response\CampaignFlowItem', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignFlowResponseListResponse(array $payload): \CCT\SDK\CampaignFlow\Response\ListResponse
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['items'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'items';
                    goto after_items;
                }

                if (is_array($value[array_key_first($value)] ?? false)) {
                    try {
                        $this->hydrationStack[] = 'items';
                        $value = $this->hydrateObjects('CCT\SDK\CampaignFlow\Response\CampaignFlowItem', $value)->toArray();
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['items'] = $value;
    
                after_items:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\CampaignFlow\Response\ListResponse', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\CampaignFlow\Response\ListResponse::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\CampaignFlow\Response\ListResponse(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\CampaignFlow\Response\ListResponse', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentAdContent(array $payload): \CCT\SDK\Campaign\Data\AdContent\AdContent
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['campaign_images'] ?? null;
    
                if ($value === null) {
                    $properties['campaignImages'] = null;
                    goto after_campaignImages;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'campaignImages';
                        $value = $this->hydrateCCTSDKCampaignDataAdContentCampaignImageCampaignImages($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['campaignImages'] = $value;
    
                after_campaignImages:

                $value = $payload['campaign_videos'] ?? null;
    
                if ($value === null) {
                    $properties['campaignVideos'] = null;
                    goto after_campaignVideos;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'campaignVideos';
                        $value = $this->hydrateCCTSDKCampaignDataAdContentCampaignVideoCampaignVideos($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['campaignVideos'] = $value;
    
                after_campaignVideos:

                $value = $payload['facebook_ai_multi_ad_variants'] ?? null;
    
                if ($value === null) {
                    $properties['facebookAiMultiAdVariants'] = null;
                    goto after_facebookAiMultiAdVariants;
                }

                static $facebookAiMultiAdVariantsCaster1;
    
                if ($facebookAiMultiAdVariantsCaster1 === null) {
                    $facebookAiMultiAdVariantsCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\AdVariant\\Facebook\\FacebookAiMultiAdVariants',
));
                }
    
                $value = $facebookAiMultiAdVariantsCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'facebookAiMultiAdVariants';
                        $value = $this->hydrateCCTSDKCampaignDataAdContentAdVariantFacebookFacebookAiMultiAdVariants($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['facebookAiMultiAdVariants'] = $value;
    
                after_facebookAiMultiAdVariants:

                $value = $payload['facebook_carousel_variants'] ?? null;
    
                if ($value === null) {
                    $properties['facebookCarouselVariants'] = null;
                    goto after_facebookCarouselVariants;
                }

                static $facebookCarouselVariantsCaster1;
    
                if ($facebookCarouselVariantsCaster1 === null) {
                    $facebookCarouselVariantsCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\AdVariant\\FacebookCarousel\\FacebookCarouselVariants',
));
                }
    
                $value = $facebookCarouselVariantsCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'facebookCarouselVariants';
                        $value = $this->hydrateCCTSDKCampaignDataAdContentAdVariantFacebookCarouselFacebookCarouselVariants($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['facebookCarouselVariants'] = $value;
    
                after_facebookCarouselVariants:

                $value = $payload['ad_text'] ?? null;
    
                if ($value === null) {
                    $properties['adText'] = null;
                    goto after_adText;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'adText';
                        $value = $this->hydrateCCTSDKCampaignDataAdContentAdText($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['adText'] = $value;
    
                after_adText:

                $value = $payload['linked_in_ad_variants'] ?? null;
    
                if ($value === null) {
                    $properties['linkedInAdVariants'] = null;
                    goto after_linkedInAdVariants;
                }

                static $linkedInAdVariantsCaster1;
    
                if ($linkedInAdVariantsCaster1 === null) {
                    $linkedInAdVariantsCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\AdVariant\\LinkedIn\\LinkedInAdVariants',
));
                }
    
                $value = $linkedInAdVariantsCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'linkedInAdVariants';
                        $value = $this->hydrateCCTSDKCampaignDataAdContentAdVariantLinkedInLinkedInAdVariants($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['linkedInAdVariants'] = $value;
    
                after_linkedInAdVariants:

                $value = $payload['twitter_ad_variants'] ?? null;
    
                if ($value === null) {
                    $properties['twitterAdVariants'] = null;
                    goto after_twitterAdVariants;
                }

                static $twitterAdVariantsCaster1;
    
                if ($twitterAdVariantsCaster1 === null) {
                    $twitterAdVariantsCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\AdVariant\\Twitter\\TwitterAdVariants',
));
                }
    
                $value = $twitterAdVariantsCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'twitterAdVariants';
                        $value = $this->hydrateCCTSDKCampaignDataAdContentAdVariantTwitterTwitterAdVariants($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['twitterAdVariants'] = $value;
    
                after_twitterAdVariants:

                $value = $payload['google_responsive_ad_variants'] ?? null;
    
                if ($value === null) {
                    $properties['googleResponsiveAdVariants'] = null;
                    goto after_googleResponsiveAdVariants;
                }

                static $googleResponsiveAdVariantsCaster1;
    
                if ($googleResponsiveAdVariantsCaster1 === null) {
                    $googleResponsiveAdVariantsCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\AdVariant\\Google\\GoogleResponsiveAdVariants',
));
                }
    
                $value = $googleResponsiveAdVariantsCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'googleResponsiveAdVariants';
                        $value = $this->hydrateCCTSDKCampaignDataAdContentAdVariantGoogleGoogleResponsiveAdVariants($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['googleResponsiveAdVariants'] = $value;
    
                after_googleResponsiveAdVariants:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdContent', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\AdContent::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\AdContent(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdContent', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentAdText(array $payload): \CCT\SDK\Campaign\Data\AdContent\AdText
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['enabled'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'enabled';
                    goto after_enabled;
                }

                static $enabledCaster1;
    
                if ($enabledCaster1 === null) {
                    $enabledCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Infrastructure\\ValueObject\\Enabled',
));
                }
    
                $value = $enabledCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'enabled';
                        $value = $this->hydrateCCTSDKInfrastructureValueObjectEnabled($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['enabled'] = $value;
    
                after_enabled:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdText', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\AdText::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\AdText(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdText', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentAdVariantFacebookCarouselFacebookCarouselCard(array $payload): \CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel\FacebookCarouselCard
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['heading'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'heading';
                    goto after_heading;
                }

                $properties['heading'] = $value;
    
                after_heading:

                $value = $payload['description'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'description';
                    goto after_description;
                }

                $properties['description'] = $value;
    
                after_description:

                $value = $payload['image'] ?? null;
    
                if ($value === null) {
                    goto after_image;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'image';
                        $value = $this->hydrateCCTSDKCampaignDataAdContentImageImage($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['image'] = $value;
    
                after_image:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel\FacebookCarouselCard', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel\FacebookCarouselCard::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel\FacebookCarouselCard(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel\FacebookCarouselCard', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentAdVariantFacebookCarouselFacebookCarouselCardCollection(array $payload): \CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel\FacebookCarouselCardCollection
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['items'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'items';
                    goto after_items;
                }

                $properties['items'] = $value;
    
                after_items:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel\FacebookCarouselCardCollection', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel\FacebookCarouselCardCollection::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel\FacebookCarouselCardCollection(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel\FacebookCarouselCardCollection', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentAdVariantFacebookCarouselFacebookCarouselVariant(array $payload): \CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel\FacebookCarouselVariant
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['text'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'text';
                    goto after_text;
                }

                $properties['text'] = $value;
    
                after_text:

                $value = $payload['card_collection'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'card_collection';
                    goto after_cardCollection;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'cardCollection';
                        $value = $this->hydrateCCTSDKCampaignDataAdContentAdVariantFacebookCarouselFacebookCarouselCardCollection($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['cardCollection'] = $value;
    
                after_cardCollection:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel\FacebookCarouselVariant', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel\FacebookCarouselVariant::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel\FacebookCarouselVariant(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel\FacebookCarouselVariant', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentAdVariantFacebookCarouselFacebookCarouselVariants(array $payload): \CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel\FacebookCarouselVariants
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['items'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'items';
                    goto after_items;
                }

                $properties['items'] = $value;
    
                after_items:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel\FacebookCarouselVariants', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel\FacebookCarouselVariants::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel\FacebookCarouselVariants(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel\FacebookCarouselVariants', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentAdVariantFacebookAiMultiVariantPartDescription(array $payload): \CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\Description
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['value'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'value';
                    goto after_value;
                }

                $properties['value'] = $value;
    
                after_value:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\Description', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\Description::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\Description(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\Description', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentAdVariantFacebookAiMultiVariantPartDescriptionCollection(array $payload): \CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\DescriptionCollection
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['items'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'items';
                    goto after_items;
                }

                static $itemsCaster1;
    
                if ($itemsCaster1 === null) {
                    $itemsCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastListToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\AdVariant\\Facebook\\AiMultiVariantPart\\DescriptionCollection',
));
                }
    
                $value = $itemsCaster1->cast($value, $this);

                $properties['items'] = $value;
    
                after_items:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\DescriptionCollection', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\DescriptionCollection::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\DescriptionCollection(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\DescriptionCollection', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentAdVariantFacebookAiMultiVariantPartHeading(array $payload): \CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\Heading
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['value'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'value';
                    goto after_value;
                }

                $properties['value'] = $value;
    
                after_value:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\Heading', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\Heading::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\Heading(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\Heading', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentAdVariantFacebookAiMultiVariantPartHeadingCollection(array $payload): \CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\HeadingCollection
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['items'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'items';
                    goto after_items;
                }

                static $itemsCaster1;
    
                if ($itemsCaster1 === null) {
                    $itemsCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastListToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\AdVariant\\Facebook\\AiMultiVariantPart\\HeadingCollection',
));
                }
    
                $value = $itemsCaster1->cast($value, $this);

                $properties['items'] = $value;
    
                after_items:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\HeadingCollection', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\HeadingCollection::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\HeadingCollection(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\HeadingCollection', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentAdVariantFacebookAiMultiVariantPartText(array $payload): \CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\Text
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['value'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'value';
                    goto after_value;
                }

                $properties['value'] = $value;
    
                after_value:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\Text', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\Text::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\Text(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\Text', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentAdVariantFacebookAiMultiVariantPartTextCollection(array $payload): \CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\TextCollection
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['items'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'items';
                    goto after_items;
                }

                static $itemsCaster1;
    
                if ($itemsCaster1 === null) {
                    $itemsCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastListToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\AdVariant\\Facebook\\AiMultiVariantPart\\TextCollection',
));
                }
    
                $value = $itemsCaster1->cast($value, $this);

                $properties['items'] = $value;
    
                after_items:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\TextCollection', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\TextCollection::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\TextCollection(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\TextCollection', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentAdVariantFacebookFacebookAiMultiAdVariant(array $payload): \CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\FacebookAiMultiAdVariant
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['texts'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'texts';
                    goto after_texts;
                }

                static $textsCaster1;
    
                if ($textsCaster1 === null) {
                    $textsCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\AdVariant\\Facebook\\AiMultiVariantPart\\TextCollection',
));
                }
    
                $value = $textsCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'texts';
                        $value = $this->hydrateCCTSDKCampaignDataAdContentAdVariantFacebookAiMultiVariantPartTextCollection($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['texts'] = $value;
    
                after_texts:

                $value = $payload['headings'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'headings';
                    goto after_headings;
                }

                static $headingsCaster1;
    
                if ($headingsCaster1 === null) {
                    $headingsCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\AdVariant\\Facebook\\AiMultiVariantPart\\HeadingCollection',
));
                }
    
                $value = $headingsCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'headings';
                        $value = $this->hydrateCCTSDKCampaignDataAdContentAdVariantFacebookAiMultiVariantPartHeadingCollection($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['headings'] = $value;
    
                after_headings:

                $value = $payload['descriptions'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'descriptions';
                    goto after_descriptions;
                }

                static $descriptionsCaster1;
    
                if ($descriptionsCaster1 === null) {
                    $descriptionsCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\AdVariant\\Facebook\\AiMultiVariantPart\\DescriptionCollection',
));
                }
    
                $value = $descriptionsCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'descriptions';
                        $value = $this->hydrateCCTSDKCampaignDataAdContentAdVariantFacebookAiMultiVariantPartDescriptionCollection($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['descriptions'] = $value;
    
                after_descriptions:

                $value = $payload['images'] ?? null;
    
                if ($value === null) {
                    $properties['images'] = null;
                    goto after_images;
                }

                static $imagesCaster1;
    
                if ($imagesCaster1 === null) {
                    $imagesCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\Image\\ImageCollection',
));
                }
    
                $value = $imagesCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'images';
                        $value = $this->hydrateCCTSDKCampaignDataAdContentImageImageCollection($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['images'] = $value;
    
                after_images:

                $value = $payload['videos'] ?? null;
    
                if ($value === null) {
                    $properties['videos'] = null;
                    goto after_videos;
                }

                static $videosCaster1;
    
                if ($videosCaster1 === null) {
                    $videosCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\Video\\VideoCollection',
));
                }
    
                $value = $videosCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'videos';
                        $value = $this->hydrateCCTSDKCampaignDataAdContentVideoVideoCollection($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['videos'] = $value;
    
                after_videos:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\FacebookAiMultiAdVariant', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\FacebookAiMultiAdVariant::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\FacebookAiMultiAdVariant(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\FacebookAiMultiAdVariant', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentAdVariantFacebookFacebookAiMultiAdVariants(array $payload): \CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\FacebookAiMultiAdVariants
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['items'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'items';
                    goto after_items;
                }

                if (is_array($value[array_key_first($value)] ?? false)) {
                    try {
                        $this->hydrationStack[] = 'items';
                        $value = $this->hydrateObjects('CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\FacebookAiMultiAdVariant', $value)->toArray();
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['items'] = $value;
    
                after_items:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\FacebookAiMultiAdVariants', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\FacebookAiMultiAdVariants::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\FacebookAiMultiAdVariants(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\FacebookAiMultiAdVariants', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentAdVariantGoogleGoogleAdVariant(array $payload): \CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleAdVariant
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['text_line1'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'text_line1';
                    goto after_textLine1;
                }

                $properties['textLine1'] = $value;
    
                after_textLine1:

                $value = $payload['text_line2'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'text_line2';
                    goto after_textLine2;
                }

                $properties['textLine2'] = $value;
    
                after_textLine2:

                $value = $payload['image_collection'] ?? null;
    
                if ($value === null) {
                    goto after_imageCollection;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'imageCollection';
                        $value = $this->hydrateCCTSDKCampaignDataAdContentImageImageCollection($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['imageCollection'] = $value;
    
                after_imageCollection:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleAdVariant', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleAdVariant::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleAdVariant(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleAdVariant', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentAdVariantGoogleGoogleAdVariants(array $payload): \CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleAdVariants
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['items'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'items';
                    goto after_items;
                }

                if (is_array($value[array_key_first($value)] ?? false)) {
                    try {
                        $this->hydrationStack[] = 'items';
                        $value = $this->hydrateObjects('CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleAdVariant', $value)->toArray();
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['items'] = $value;
    
                after_items:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleAdVariants', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleAdVariants::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleAdVariants(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleAdVariants', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentAdVariantGoogleGoogleResponsiveAdVariant(array $payload): \CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleResponsiveAdVariant
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['short_headlines'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'short_headlines';
                    goto after_shortHeadlines;
                }

                static $shortHeadlinesCaster1;
    
                if ($shortHeadlinesCaster1 === null) {
                    $shortHeadlinesCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\AdVariant\\Google\\ResponsiveAd\\ShortHeadlineCollection',
));
                }
    
                $value = $shortHeadlinesCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'shortHeadlines';
                        $value = $this->hydrateCCTSDKCampaignDataAdContentAdVariantGoogleResponsiveAdShortHeadlineCollection($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['shortHeadlines'] = $value;
    
                after_shortHeadlines:

                $value = $payload['long_headline'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'long_headline';
                    goto after_longHeadline;
                }

                static $longHeadlineCaster1;
    
                if ($longHeadlineCaster1 === null) {
                    $longHeadlineCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\AdVariant\\Google\\ResponsiveAd\\LongHeadline',
));
                }
    
                $value = $longHeadlineCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'longHeadline';
                        $value = $this->hydrateCCTSDKCampaignDataAdContentAdVariantGoogleResponsiveAdLongHeadline($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['longHeadline'] = $value;
    
                after_longHeadline:

                $value = $payload['descriptions'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'descriptions';
                    goto after_descriptions;
                }

                static $descriptionsCaster1;
    
                if ($descriptionsCaster1 === null) {
                    $descriptionsCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\AdVariant\\Google\\ResponsiveAd\\DescriptionCollection',
));
                }
    
                $value = $descriptionsCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'descriptions';
                        $value = $this->hydrateCCTSDKCampaignDataAdContentAdVariantGoogleResponsiveAdDescriptionCollection($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['descriptions'] = $value;
    
                after_descriptions:

                $value = $payload['images'] ?? null;
    
                if ($value === null) {
                    $properties['images'] = null;
                    goto after_images;
                }

                static $imagesCaster1;
    
                if ($imagesCaster1 === null) {
                    $imagesCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\Image\\ImageCollection',
));
                }
    
                $value = $imagesCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'images';
                        $value = $this->hydrateCCTSDKCampaignDataAdContentImageImageCollection($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['images'] = $value;
    
                after_images:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleResponsiveAdVariant', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleResponsiveAdVariant::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleResponsiveAdVariant(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleResponsiveAdVariant', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentAdVariantGoogleGoogleResponsiveAdVariants(array $payload): \CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleResponsiveAdVariants
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['items'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'items';
                    goto after_items;
                }

                if (is_array($value[array_key_first($value)] ?? false)) {
                    try {
                        $this->hydrationStack[] = 'items';
                        $value = $this->hydrateObjects('CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleResponsiveAdVariant', $value)->toArray();
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['items'] = $value;
    
                after_items:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleResponsiveAdVariants', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleResponsiveAdVariants::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleResponsiveAdVariants(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleResponsiveAdVariants', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentAdVariantGoogleResponsiveAdDescription(array $payload): \CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\Description
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['value'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'value';
                    goto after_value;
                }

                $properties['value'] = $value;
    
                after_value:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\Description', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\Description::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\Description(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\Description', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentAdVariantGoogleResponsiveAdDescriptionCollection(array $payload): \CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\DescriptionCollection
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['items'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'items';
                    goto after_items;
                }

                static $itemsCaster1;
    
                if ($itemsCaster1 === null) {
                    $itemsCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastListToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\AdVariant\\Google\\ResponsiveAd\\DescriptionCollection',
));
                }
    
                $value = $itemsCaster1->cast($value, $this);

                $properties['items'] = $value;
    
                after_items:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\DescriptionCollection', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\DescriptionCollection::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\DescriptionCollection(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\DescriptionCollection', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentAdVariantGoogleResponsiveAdLongHeadline(array $payload): \CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\LongHeadline
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['value'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'value';
                    goto after_value;
                }

                $properties['value'] = $value;
    
                after_value:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\LongHeadline', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\LongHeadline::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\LongHeadline(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\LongHeadline', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentAdVariantGoogleResponsiveAdShortHeadline(array $payload): \CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\ShortHeadline
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['value'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'value';
                    goto after_value;
                }

                $properties['value'] = $value;
    
                after_value:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\ShortHeadline', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\ShortHeadline::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\ShortHeadline(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\ShortHeadline', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentAdVariantGoogleResponsiveAdShortHeadlineCollection(array $payload): \CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\ShortHeadlineCollection
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['items'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'items';
                    goto after_items;
                }

                static $itemsCaster1;
    
                if ($itemsCaster1 === null) {
                    $itemsCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastListToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\AdVariant\\Google\\ResponsiveAd\\ShortHeadlineCollection',
));
                }
    
                $value = $itemsCaster1->cast($value, $this);

                $properties['items'] = $value;
    
                after_items:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\ShortHeadlineCollection', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\ShortHeadlineCollection::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\ShortHeadlineCollection(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\ShortHeadlineCollection', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentAdVariantLinkedInLinkedInAdVariant(array $payload): \CCT\SDK\Campaign\Data\AdContent\AdVariant\LinkedIn\LinkedInAdVariant
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['text'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'text';
                    goto after_text;
                }

                $properties['text'] = $value;
    
                after_text:

                $value = $payload['images'] ?? null;
    
                if ($value === null) {
                    $properties['images'] = null;
                    goto after_images;
                }

                static $imagesCaster1;
    
                if ($imagesCaster1 === null) {
                    $imagesCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\Image\\ImageCollection',
));
                }
    
                $value = $imagesCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'images';
                        $value = $this->hydrateCCTSDKCampaignDataAdContentImageImageCollection($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['images'] = $value;
    
                after_images:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\LinkedIn\LinkedInAdVariant', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\AdVariant\LinkedIn\LinkedInAdVariant::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\AdVariant\LinkedIn\LinkedInAdVariant(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\LinkedIn\LinkedInAdVariant', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentAdVariantLinkedInLinkedInAdVariants(array $payload): \CCT\SDK\Campaign\Data\AdContent\AdVariant\LinkedIn\LinkedInAdVariants
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['items'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'items';
                    goto after_items;
                }

                if (is_array($value[array_key_first($value)] ?? false)) {
                    try {
                        $this->hydrationStack[] = 'items';
                        $value = $this->hydrateObjects('CCT\SDK\Campaign\Data\AdContent\AdVariant\LinkedIn\LinkedInAdVariant', $value)->toArray();
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['items'] = $value;
    
                after_items:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\LinkedIn\LinkedInAdVariants', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\AdVariant\LinkedIn\LinkedInAdVariants::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\AdVariant\LinkedIn\LinkedInAdVariants(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\LinkedIn\LinkedInAdVariants', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentAdVariantTwitterTwitterAdVariant(array $payload): \CCT\SDK\Campaign\Data\AdContent\AdVariant\Twitter\TwitterAdVariant
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['text'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'text';
                    goto after_text;
                }

                $properties['text'] = $value;
    
                after_text:

                $value = $payload['image_collection'] ?? null;
    
                if ($value === null) {
                    goto after_imageCollection;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'imageCollection';
                        $value = $this->hydrateCCTSDKCampaignDataAdContentImageImageCollection($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['imageCollection'] = $value;
    
                after_imageCollection:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Twitter\TwitterAdVariant', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\AdVariant\Twitter\TwitterAdVariant::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\AdVariant\Twitter\TwitterAdVariant(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Twitter\TwitterAdVariant', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentAdVariantTwitterTwitterAdVariants(array $payload): \CCT\SDK\Campaign\Data\AdContent\AdVariant\Twitter\TwitterAdVariants
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['items'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'items';
                    goto after_items;
                }

                if (is_array($value[array_key_first($value)] ?? false)) {
                    try {
                        $this->hydrationStack[] = 'items';
                        $value = $this->hydrateObjects('CCT\SDK\Campaign\Data\AdContent\AdVariant\Twitter\TwitterAdVariant', $value)->toArray();
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['items'] = $value;
    
                after_items:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Twitter\TwitterAdVariants', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\AdVariant\Twitter\TwitterAdVariants::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\AdVariant\Twitter\TwitterAdVariants(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\AdVariant\Twitter\TwitterAdVariants', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentCampaignImageCampaignImages(array $payload): \CCT\SDK\Campaign\Data\AdContent\CampaignImage\CampaignImages
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['channel_images'] ?? null;
    
                if ($value === null) {
                    $properties['channelImages'] = null;
                    goto after_channelImages;
                }

                static $channelImagesCaster1;
    
                if ($channelImagesCaster1 === null) {
                    $channelImagesCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\CampaignImage\\ChannelImage\\ChannelCollection',
));
                }
    
                $value = $channelImagesCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'channelImages';
                        $value = $this->hydrateCCTSDKCampaignDataAdContentCampaignImageChannelImageChannelCollection($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['channelImages'] = $value;
    
                after_channelImages:

                $value = $payload['user_images_selected'] ?? null;
    
                if ($value === null) {
                    goto after_userImagesSelected;
                }

                $properties['userImagesSelected'] = $value;
    
                after_userImagesSelected:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\CampaignImage\CampaignImages', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\CampaignImage\CampaignImages::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\CampaignImage\CampaignImages(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\CampaignImage\CampaignImages', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentCampaignImageChannelImageAbstractChannelImages(array $payload): \CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\AbstractChannelImages
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['images'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'images';
                    goto after_images;
                }

                static $imagesCaster1;
    
                if ($imagesCaster1 === null) {
                    $imagesCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\Image\\ImageCollection',
));
                }
    
                $value = $imagesCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'images';
                        $value = $this->hydrateCCTSDKCampaignDataAdContentImageImageCollection($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['images'] = $value;
    
                after_images:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\AbstractChannelImages', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\AbstractChannelImages::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\AbstractChannelImages(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\AbstractChannelImages', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentCampaignImageChannelImageChannelCollection(array $payload): \CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\ChannelCollection
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['items'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'items';
                    goto after_items;
                }

                static $itemsCaster1;
    
                if ($itemsCaster1 === null) {
                    $itemsCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastListUnionToType(...array (
  0 => 
  array (
    'facebook_images' => 'CCT\\SDK\\Campaign\\Data\\AdContent\\CampaignImage\\ChannelImage\\FacebookImages',
    'google_images' => 'CCT\\SDK\\Campaign\\Data\\AdContent\\CampaignImage\\ChannelImage\\GoogleImages',
    'general_images' => 'CCT\\SDK\\Campaign\\Data\\AdContent\\CampaignImage\\ChannelImage\\GeneralImages',
  ),
));
                }
    
                $value = $itemsCaster1->cast($value, $this);

                $properties['items'] = $value;
    
                after_items:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\ChannelCollection', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\ChannelCollection::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\ChannelCollection(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\ChannelCollection', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentCampaignImageChannelImageFacebookImages(array $payload): \CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\FacebookImages
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['images'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'images';
                    goto after_images;
                }

                static $imagesCaster1;
    
                if ($imagesCaster1 === null) {
                    $imagesCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\Image\\ImageCollection',
));
                }
    
                $value = $imagesCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'images';
                        $value = $this->hydrateCCTSDKCampaignDataAdContentImageImageCollection($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['images'] = $value;
    
                after_images:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\FacebookImages', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\FacebookImages::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\FacebookImages(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\FacebookImages', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentCampaignImageChannelImageGeneralImages(array $payload): \CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\GeneralImages
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['images'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'images';
                    goto after_images;
                }

                static $imagesCaster1;
    
                if ($imagesCaster1 === null) {
                    $imagesCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\Image\\ImageCollection',
));
                }
    
                $value = $imagesCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'images';
                        $value = $this->hydrateCCTSDKCampaignDataAdContentImageImageCollection($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['images'] = $value;
    
                after_images:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\GeneralImages', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\GeneralImages::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\GeneralImages(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\GeneralImages', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentCampaignImageChannelImageGoogleImages(array $payload): \CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\GoogleImages
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['images'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'images';
                    goto after_images;
                }

                static $imagesCaster1;
    
                if ($imagesCaster1 === null) {
                    $imagesCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\Image\\ImageCollection',
));
                }
    
                $value = $imagesCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'images';
                        $value = $this->hydrateCCTSDKCampaignDataAdContentImageImageCollection($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['images'] = $value;
    
                after_images:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\GoogleImages', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\GoogleImages::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\GoogleImages(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\GoogleImages', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentCampaignVideoCampaignVideos(array $payload): \CCT\SDK\Campaign\Data\AdContent\CampaignVideo\CampaignVideos
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['videos'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'videos';
                    goto after_videos;
                }

                static $videosCaster1;
    
                if ($videosCaster1 === null) {
                    $videosCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\Video\\VideoCollection',
));
                }
    
                $value = $videosCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'videos';
                        $value = $this->hydrateCCTSDKCampaignDataAdContentVideoVideoCollection($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['videos'] = $value;
    
                after_videos:

                $value = $payload['user_selected'] ?? null;
    
                if ($value === null) {
                    goto after_userSelected;
                }

                $properties['userSelected'] = $value;
    
                after_userSelected:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\CampaignVideo\CampaignVideos', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\CampaignVideo\CampaignVideos::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\CampaignVideo\CampaignVideos(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\CampaignVideo\CampaignVideos', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentImageImage(array $payload): \CCT\SDK\Campaign\Data\AdContent\Image\Image
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['image_url'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'image_url';
                    goto after_imageUrl;
                }

                static $imageUrlCaster1;
    
                if ($imageUrlCaster1 === null) {
                    $imageUrlCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Infrastructure\\ValueObject\\Uri',
));
                }
    
                $value = $imageUrlCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'imageUrl';
                        $value = $this->hydrateCCTSDKInfrastructureValueObjectUri($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['imageUrl'] = $value;
    
                after_imageUrl:

                $value = $payload['uuid'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'uuid';
                    goto after_uuid;
                }

                static $uuidCaster1;
    
                if ($uuidCaster1 === null) {
                    $uuidCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\Image\\ImageId',
));
                }
    
                $value = $uuidCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'uuid';
                        $value = $this->hydrateCCTSDKCampaignDataAdContentImageImageId($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['uuid'] = $value;
    
                after_uuid:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\Image\Image', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\Image\Image::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\Image\Image(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\Image\Image', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentImageImageCollection(array $payload): \CCT\SDK\Campaign\Data\AdContent\Image\ImageCollection
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['items'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'items';
                    goto after_items;
                }

                if (is_array($value[array_key_first($value)] ?? false)) {
                    try {
                        $this->hydrationStack[] = 'items';
                        $value = $this->hydrateObjects('CCT\SDK\Campaign\Data\AdContent\Image\Image', $value)->toArray();
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['items'] = $value;
    
                after_items:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\Image\ImageCollection', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\Image\ImageCollection::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\Image\ImageCollection(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\Image\ImageCollection', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentImageImageId(array $payload): \CCT\SDK\Campaign\Data\AdContent\Image\ImageId
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['value'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'value';
                    goto after_value;
                }

                static $valueCaster1;
    
                if ($valueCaster1 === null) {
                    $valueCaster1 = new \EventSauce\ObjectHydrator\PropertyCasters\CastToUuid(...array (
));
                }
    
                $value = $valueCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'value';
                        $value = $this->hydrateRamseyUuidUuidInterface($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['value'] = $value;
    
                after_value:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\Image\ImageId', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\Image\ImageId::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\Image\ImageId(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\Image\ImageId', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentUserSelected(array $payload): \CCT\SDK\Campaign\Data\AdContent\UserSelected
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['value'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'value';
                    goto after_value;
                }

                $properties['value'] = $value;
    
                after_value:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\UserSelected', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\UserSelected::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\UserSelected(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\UserSelected', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentVideoVideo(array $payload): \CCT\SDK\Campaign\Data\AdContent\Video\Video
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['video_url'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'video_url';
                    goto after_videoUrl;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'videoUrl';
                        $value = $this->hydrateCCTSDKInfrastructureValueObjectUri($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['videoUrl'] = $value;
    
                after_videoUrl:

                $value = $payload['uuid'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'uuid';
                    goto after_uuid;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'uuid';
                        $value = $this->hydrateCCTSDKCampaignDataAdContentVideoVideoId($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['uuid'] = $value;
    
                after_uuid:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\Video\Video', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\Video\Video::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\Video\Video(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\Video\Video', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentVideoVideoCollection(array $payload): \CCT\SDK\Campaign\Data\AdContent\Video\VideoCollection
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['items'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'items';
                    goto after_items;
                }

                $properties['items'] = $value;
    
                after_items:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\Video\VideoCollection', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\Video\VideoCollection::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\Video\VideoCollection(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\Video\VideoCollection', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataAdContentVideoVideoId(array $payload): \CCT\SDK\Campaign\Data\AdContent\Video\VideoId
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['value'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'value';
                    goto after_value;
                }

                static $valueCaster1;
    
                if ($valueCaster1 === null) {
                    $valueCaster1 = new \EventSauce\ObjectHydrator\PropertyCasters\CastToUuid(...array (
));
                }
    
                $value = $valueCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'value';
                        $value = $this->hydrateRamseyUuidUuidInterface($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['value'] = $value;
    
                after_value:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\Video\VideoId', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\AdContent\Video\VideoId::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\AdContent\Video\VideoId(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\AdContent\Video\VideoId', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataCampaignId(array $payload): \CCT\SDK\Campaign\Data\CampaignId
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['value'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'value';
                    goto after_value;
                }

                static $valueCaster1;
    
                if ($valueCaster1 === null) {
                    $valueCaster1 = new \EventSauce\ObjectHydrator\PropertyCasters\CastToUuid(...array (
));
                }
    
                $value = $valueCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'value';
                        $value = $this->hydrateRamseyUuidUuidInterface($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['value'] = $value;
    
                after_value:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\CampaignId', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\CampaignId::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\CampaignId(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\CampaignId', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataDetailsCampaignPeriod(array $payload): \CCT\SDK\Campaign\Data\Details\CampaignPeriod
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['start_date'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'start_date';
                    goto after_startDate;
                }

                static $startDateCaster1;
    
                if ($startDateCaster1 === null) {
                    $startDateCaster1 = new \EventSauce\ObjectHydrator\PropertyCasters\CastToDateTimeImmutable(...array (
  0 => 'Y-m-d',
));
                }
    
                $value = $startDateCaster1->cast($value, $this);

                $properties['startDate'] = $value;
    
                after_startDate:

                $value = $payload['end_date'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'end_date';
                    goto after_endDate;
                }

                static $endDateCaster1;
    
                if ($endDateCaster1 === null) {
                    $endDateCaster1 = new \EventSauce\ObjectHydrator\PropertyCasters\CastToDateTimeImmutable(...array (
  0 => 'Y-m-d',
));
                }
    
                $value = $endDateCaster1->cast($value, $this);

                $properties['endDate'] = $value;
    
                after_endDate:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Details\CampaignPeriod', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\Details\CampaignPeriod::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\Details\CampaignPeriod(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Details\CampaignPeriod', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataDetailsCampaignTitle(array $payload): \CCT\SDK\Campaign\Data\Details\CampaignTitle
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['value'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'value';
                    goto after_value;
                }

                $properties['value'] = $value;
    
                after_value:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Details\CampaignTitle', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\Details\CampaignTitle::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\Details\CampaignTitle(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Details\CampaignTitle', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataDetailsDetails(array $payload): \CCT\SDK\Campaign\Data\Details\Details
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['campaign_title'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'campaign_title';
                    goto after_campaignTitle;
                }

                static $campaignTitleCaster1;
    
                if ($campaignTitleCaster1 === null) {
                    $campaignTitleCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\Details\\CampaignTitle',
));
                }
    
                $value = $campaignTitleCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'campaignTitle';
                        $value = $this->hydrateCCTSDKCampaignDataDetailsCampaignTitle($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['campaignTitle'] = $value;
    
                after_campaignTitle:

                $value = $payload['campaign_period'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'campaign_period';
                    goto after_campaignPeriod;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'campaignPeriod';
                        $value = $this->hydrateCCTSDKCampaignDataDetailsCampaignPeriod($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['campaignPeriod'] = $value;
    
                after_campaignPeriod:

                $value = $payload['landing_page'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'landing_page';
                    goto after_landingPage;
                }

                static $landingPageCaster1;
    
                if ($landingPageCaster1 === null) {
                    $landingPageCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\Details\\LandingPage',
));
                }
    
                $value = $landingPageCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'landingPage';
                        $value = $this->hydrateCCTSDKCampaignDataDetailsLandingPage($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['landingPage'] = $value;
    
                after_landingPage:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Details\Details', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\Details\Details::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\Details\Details(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Details\Details', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataDetailsLandingPage(array $payload): \CCT\SDK\Campaign\Data\Details\LandingPage
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['value'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'value';
                    goto after_value;
                }

                $properties['value'] = $value;
    
                after_value:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Details\LandingPage', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\Details\LandingPage::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\Details\LandingPage(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Details\LandingPage', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataOptionsAdvancedSlideshow(array $payload): \CCT\SDK\Campaign\Data\Options\AdvancedSlideshow
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['enabled'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'enabled';
                    goto after_enabled;
                }

                static $enabledCaster1;
    
                if ($enabledCaster1 === null) {
                    $enabledCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Infrastructure\\ValueObject\\Enabled',
));
                }
    
                $value = $enabledCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'enabled';
                        $value = $this->hydrateCCTSDKInfrastructureValueObjectEnabled($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['enabled'] = $value;
    
                after_enabled:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Options\AdvancedSlideshow', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\Options\AdvancedSlideshow::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\Options\AdvancedSlideshow(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Options\AdvancedSlideshow', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataOptionsAfterSoldAction(array $payload): \CCT\SDK\Campaign\Data\Options\AfterSoldAction
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['action_type'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'action_type';
                    goto after_actionType;
                }

                $value = \CCT\SDK\Campaign\Data\Options\ActionType::from($value);

                $properties['actionType'] = $value;
    
                after_actionType:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Options\AfterSoldAction', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\Options\AfterSoldAction::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\Options\AfterSoldAction(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Options\AfterSoldAction', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataOptionsFacebookSlideshow(array $payload): \CCT\SDK\Campaign\Data\Options\FacebookSlideshow
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['enabled'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'enabled';
                    goto after_enabled;
                }

                static $enabledCaster1;
    
                if ($enabledCaster1 === null) {
                    $enabledCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Infrastructure\\ValueObject\\Enabled',
));
                }
    
                $value = $enabledCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'enabled';
                        $value = $this->hydrateCCTSDKInfrastructureValueObjectEnabled($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['enabled'] = $value;
    
                after_enabled:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Options\FacebookSlideshow', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\Options\FacebookSlideshow::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\Options\FacebookSlideshow(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Options\FacebookSlideshow', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataOptionsLocalBoost(array $payload): \CCT\SDK\Campaign\Data\Options\LocalBoost
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['enabled'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'enabled';
                    goto after_enabled;
                }

                static $enabledCaster1;
    
                if ($enabledCaster1 === null) {
                    $enabledCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Infrastructure\\ValueObject\\Enabled',
));
                }
    
                $value = $enabledCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'enabled';
                        $value = $this->hydrateCCTSDKInfrastructureValueObjectEnabled($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['enabled'] = $value;
    
                after_enabled:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Options\LocalBoost', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\Options\LocalBoost::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\Options\LocalBoost(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Options\LocalBoost', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataOptionsNewPrice(array $payload): \CCT\SDK\Campaign\Data\Options\NewPrice
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['enabled'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'enabled';
                    goto after_enabled;
                }

                static $enabledCaster1;
    
                if ($enabledCaster1 === null) {
                    $enabledCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Infrastructure\\ValueObject\\Enabled',
));
                }
    
                $value = $enabledCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'enabled';
                        $value = $this->hydrateCCTSDKInfrastructureValueObjectEnabled($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['enabled'] = $value;
    
                after_enabled:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Options\NewPrice', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\Options\NewPrice::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\Options\NewPrice(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Options\NewPrice', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataOptionsOptions(array $payload): \CCT\SDK\Campaign\Data\Options\Options
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['advanced_slideshow'] ?? null;
    
                if ($value === null) {
                    $properties['advancedSlideshow'] = null;
                    goto after_advancedSlideshow;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'advancedSlideshow';
                        $value = $this->hydrateCCTSDKCampaignDataOptionsAdvancedSlideshow($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['advancedSlideshow'] = $value;
    
                after_advancedSlideshow:

                $value = $payload['facebook_slideshow'] ?? null;
    
                if ($value === null) {
                    $properties['facebookSlideshow'] = null;
                    goto after_facebookSlideshow;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'facebookSlideshow';
                        $value = $this->hydrateCCTSDKCampaignDataOptionsFacebookSlideshow($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['facebookSlideshow'] = $value;
    
                after_facebookSlideshow:

                $value = $payload['local_boost'] ?? null;
    
                if ($value === null) {
                    $properties['localBoost'] = null;
                    goto after_localBoost;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'localBoost';
                        $value = $this->hydrateCCTSDKCampaignDataOptionsLocalBoost($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['localBoost'] = $value;
    
                after_localBoost:

                $value = $payload['post_first_variant_to_facebook'] ?? null;
    
                if ($value === null) {
                    $properties['postFirstVariantToFacebook'] = null;
                    goto after_postFirstVariantToFacebook;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'postFirstVariantToFacebook';
                        $value = $this->hydrateCCTSDKCampaignDataOptionsPostFirstVariantToFacebook($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['postFirstVariantToFacebook'] = $value;
    
                after_postFirstVariantToFacebook:

                $value = $payload['after_sold_action'] ?? null;
    
                if ($value === null) {
                    $properties['afterSoldAction'] = null;
                    goto after_afterSoldAction;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'afterSoldAction';
                        $value = $this->hydrateCCTSDKCampaignDataOptionsAfterSoldAction($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['afterSoldAction'] = $value;
    
                after_afterSoldAction:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Options\Options', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\Options\Options::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\Options\Options(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Options\Options', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataOptionsPostFirstVariantToFacebook(array $payload): \CCT\SDK\Campaign\Data\Options\PostFirstVariantToFacebook
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['enabled'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'enabled';
                    goto after_enabled;
                }

                static $enabledCaster1;
    
                if ($enabledCaster1 === null) {
                    $enabledCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Infrastructure\\ValueObject\\Enabled',
));
                }
    
                $value = $enabledCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'enabled';
                        $value = $this->hydrateCCTSDKInfrastructureValueObjectEnabled($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['enabled'] = $value;
    
                after_enabled:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Options\PostFirstVariantToFacebook', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\Options\PostFirstVariantToFacebook::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\Options\PostFirstVariantToFacebook(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Options\PostFirstVariantToFacebook', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataTargetingLocationTargetingAddress(array $payload): \CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Address
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['street_number'] ?? null;
    
                if ($value === null) {
                    goto after_streetNumber;
                }

                $properties['streetNumber'] = $value;
    
                after_streetNumber:

                $value = $payload['street_name'] ?? null;
    
                if ($value === null) {
                    goto after_streetName;
                }

                $properties['streetName'] = $value;
    
                after_streetName:

                $value = $payload['neighborhood'] ?? null;
    
                if ($value === null) {
                    goto after_neighborhood;
                }

                $properties['neighborhood'] = $value;
    
                after_neighborhood:

                $value = $payload['locality'] ?? null;
    
                if ($value === null) {
                    goto after_locality;
                }

                $properties['locality'] = $value;
    
                after_locality:

                $value = $payload['region'] ?? null;
    
                if ($value === null) {
                    goto after_region;
                }

                $properties['region'] = $value;
    
                after_region:

                $value = $payload['postal_code'] ?? null;
    
                if ($value === null) {
                    goto after_postalCode;
                }

                $properties['postalCode'] = $value;
    
                after_postalCode:

                $value = $payload['country'] ?? null;
    
                if ($value === null) {
                    goto after_country;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'country';
                        $value = $this->hydrateCCTSDKCampaignDataTargetingLocationTargetingCountry($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['country'] = $value;
    
                after_country:

                $value = $payload['formatted_address'] ?? null;
    
                if ($value === null) {
                    goto after_formattedAddress;
                }

                $properties['formattedAddress'] = $value;
    
                after_formattedAddress:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Address', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Address::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Address(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Address', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataTargetingLocationTargetingCoordinate(array $payload): \CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Coordinate
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['latitude'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'latitude';
                    goto after_latitude;
                }

                $properties['latitude'] = $value;
    
                after_latitude:

                $value = $payload['longitude'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'longitude';
                    goto after_longitude;
                }

                $properties['longitude'] = $value;
    
                after_longitude:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Coordinate', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Coordinate::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Coordinate(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Coordinate', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataTargetingLocationTargetingCountry(array $payload): \CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Country
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['name'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'name';
                    goto after_name;
                }

                $properties['name'] = $value;
    
                after_name:

                $value = $payload['code'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'code';
                    goto after_code;
                }

                $properties['code'] = $value;
    
                after_code:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Country', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Country::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Country(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Country', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataTargetingLocationTargetingIndustryAddress(array $payload): \CCT\SDK\Campaign\Data\Targeting\LocationTargeting\IndustryAddress
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['address'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'address';
                    goto after_address;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'address';
                        $value = $this->hydrateCCTSDKCampaignDataTargetingLocationTargetingAddress($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['address'] = $value;
    
                after_address:

                $value = $payload['coordinate'] ?? null;
    
                if ($value === null) {
                    $properties['coordinate'] = null;
                    goto after_coordinate;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'coordinate';
                        $value = $this->hydrateCCTSDKCampaignDataTargetingLocationTargetingCoordinate($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['coordinate'] = $value;
    
                after_coordinate:

                $value = $payload['type'] ?? null;
    
                if ($value === null) {
                    goto after_type;
                }

                $value = \CCT\SDK\Campaign\Data\Targeting\LocationTargeting\LocationType::from($value);

                $properties['type'] = $value;
    
                after_type:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Targeting\LocationTargeting\IndustryAddress', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\Targeting\LocationTargeting\IndustryAddress::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\Targeting\LocationTargeting\IndustryAddress(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Targeting\LocationTargeting\IndustryAddress', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataTargetingLocationTargetingLocation(array $payload): \CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Location
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['address'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'address';
                    goto after_address;
                }

                $properties['address'] = $value;
    
                after_address:

                $value = $payload['coordinate'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'coordinate';
                    goto after_coordinate;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'coordinate';
                        $value = $this->hydrateCCTSDKCampaignDataTargetingLocationTargetingCoordinate($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['coordinate'] = $value;
    
                after_coordinate:

                $value = $payload['radius'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'radius';
                    goto after_radius;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'radius';
                        $value = $this->hydrateCCTSDKCampaignDataTargetingLocationTargetingRadius($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['radius'] = $value;
    
                after_radius:

                $value = $payload['type'] ?? null;
    
                if ($value === null) {
                    goto after_type;
                }

                $value = \CCT\SDK\Campaign\Data\Targeting\LocationTargeting\LocationType::from($value);

                $properties['type'] = $value;
    
                after_type:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Location', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Location::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Location(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Location', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataTargetingLocationTargetingLocations(array $payload): \CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Locations
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['items'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'items';
                    goto after_items;
                }

                if (is_array($value[array_key_first($value)] ?? false)) {
                    try {
                        $this->hydrationStack[] = 'items';
                        $value = $this->hydrateObjects('CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Location', $value)->toArray();
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['items'] = $value;
    
                after_items:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Locations', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Locations::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Locations(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Locations', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataTargetingLocationTargetingRadius(array $payload): \CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Radius
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['radius'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'radius';
                    goto after_radius;
                }

                $properties['radius'] = $value;
    
                after_radius:

                $value = $payload['measurement_unit'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'measurement_unit';
                    goto after_measurementUnit;
                }

                $value = \CCT\SDK\Campaign\Data\Targeting\LocationTargeting\MeasurementUnit::from($value);

                $properties['measurementUnit'] = $value;
    
                after_measurementUnit:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Radius', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Radius::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Radius(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Radius', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataTargetingPropertyInformationNumberOfBedrooms(array $payload): \CCT\SDK\Campaign\Data\Targeting\PropertyInformation\NumberOfBedrooms
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['value'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'value';
                    goto after_value;
                }

                $properties['value'] = $value;
    
                after_value:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Targeting\PropertyInformation\NumberOfBedrooms', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\Targeting\PropertyInformation\NumberOfBedrooms::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\Targeting\PropertyInformation\NumberOfBedrooms(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Targeting\PropertyInformation\NumberOfBedrooms', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataTargetingPropertyInformationPropertyInformation(array $payload): \CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertyInformation
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['property_price'] ?? null;
    
                if ($value === null) {
                    $properties['propertyPrice'] = null;
                    goto after_propertyPrice;
                }

                static $propertyPriceCaster1;
    
                if ($propertyPriceCaster1 === null) {
                    $propertyPriceCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\Targeting\\PropertyInformation\\PropertyPrice',
));
                }
    
                $value = $propertyPriceCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'propertyPrice';
                        $value = $this->hydrateCCTSDKCampaignDataTargetingPropertyInformationPropertyPrice($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['propertyPrice'] = $value;
    
                after_propertyPrice:

                $value = $payload['property_size'] ?? null;
    
                if ($value === null) {
                    $properties['propertySize'] = null;
                    goto after_propertySize;
                }

                static $propertySizeCaster1;
    
                if ($propertySizeCaster1 === null) {
                    $propertySizeCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\Targeting\\PropertyInformation\\PropertySize',
));
                }
    
                $value = $propertySizeCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'propertySize';
                        $value = $this->hydrateCCTSDKCampaignDataTargetingPropertyInformationPropertySize($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['propertySize'] = $value;
    
                after_propertySize:

                $value = $payload['number_of_bedrooms'] ?? null;
    
                if ($value === null) {
                    $properties['numberOfBedrooms'] = null;
                    goto after_numberOfBedrooms;
                }

                static $numberOfBedroomsCaster1;
    
                if ($numberOfBedroomsCaster1 === null) {
                    $numberOfBedroomsCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\Targeting\\PropertyInformation\\NumberOfBedrooms',
));
                }
    
                $value = $numberOfBedroomsCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'numberOfBedrooms';
                        $value = $this->hydrateCCTSDKCampaignDataTargetingPropertyInformationNumberOfBedrooms($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['numberOfBedrooms'] = $value;
    
                after_numberOfBedrooms:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertyInformation', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertyInformation::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertyInformation(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertyInformation', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataTargetingPropertyInformationPropertyPrice(array $payload): \CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertyPrice
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['value'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'value';
                    goto after_value;
                }

                $properties['value'] = $value;
    
                after_value:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertyPrice', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertyPrice::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertyPrice(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertyPrice', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataTargetingPropertyInformationPropertySize(array $payload): \CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertySize
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['value'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'value';
                    goto after_value;
                }

                $properties['value'] = $value;
    
                after_value:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertySize', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertySize::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertySize(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertySize', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignDataTargetingTargeting(array $payload): \CCT\SDK\Campaign\Data\Targeting\Targeting
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['locations'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'locations';
                    goto after_locations;
                }

                static $locationsCaster1;
    
                if ($locationsCaster1 === null) {
                    $locationsCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\Targeting\\LocationTargeting\\Locations',
));
                }
    
                $value = $locationsCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'locations';
                        $value = $this->hydrateCCTSDKCampaignDataTargetingLocationTargetingLocations($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['locations'] = $value;
    
                after_locations:

                $value = $payload['industry_address'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'industry_address';
                    goto after_industryAddress;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'industryAddress';
                        $value = $this->hydrateCCTSDKCampaignDataTargetingLocationTargetingIndustryAddress($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['industryAddress'] = $value;
    
                after_industryAddress:

                $value = $payload['property_information'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'property_information';
                    goto after_propertyInformation;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'propertyInformation';
                        $value = $this->hydrateCCTSDKCampaignDataTargetingPropertyInformationPropertyInformation($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['propertyInformation'] = $value;
    
                after_propertyInformation:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Targeting\Targeting', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Data\Targeting\Targeting::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Data\Targeting\Targeting(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Data\Targeting\Targeting', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignPayloadCreateCampaign(array $payload): \CCT\SDK\Campaign\Payload\CreateCampaign
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['campaign_flow_uuid'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'campaign_flow_uuid';
                    goto after_campaignFlowId;
                }

                static $campaignFlowIdCaster1;
    
                if ($campaignFlowIdCaster1 === null) {
                    $campaignFlowIdCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\CampaignFlow\\Data\\CampaignFlowId',
));
                }
    
                $value = $campaignFlowIdCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'campaignFlowId';
                        $value = $this->hydrateCCTSDKCampaignFlowDataCampaignFlowId($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['campaignFlowId'] = $value;
    
                after_campaignFlowId:

                $value = $payload['details'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'details';
                    goto after_details;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'details';
                        $value = $this->hydrateCCTSDKCampaignDataDetailsDetails($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['details'] = $value;
    
                after_details:

                $value = $payload['ad_content'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'ad_content';
                    goto after_adContent;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'adContent';
                        $value = $this->hydrateCCTSDKCampaignDataAdContentAdContent($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['adContent'] = $value;
    
                after_adContent:

                $value = $payload['targeting'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'targeting';
                    goto after_targeting;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'targeting';
                        $value = $this->hydrateCCTSDKCampaignDataTargetingTargeting($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['targeting'] = $value;
    
                after_targeting:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Payload\CreateCampaign', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Payload\CreateCampaign::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Payload\CreateCampaign(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Payload\CreateCampaign', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignPayloadSaveCampaign(array $payload): \CCT\SDK\Campaign\Payload\SaveCampaign
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['details'] ?? null;
    
                if ($value === null) {
                    $properties['details'] = null;
                    goto after_details;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'details';
                        $value = $this->hydrateCCTSDKCampaignDataDetailsDetails($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['details'] = $value;
    
                after_details:

                $value = $payload['ad_content'] ?? null;
    
                if ($value === null) {
                    $properties['adContent'] = null;
                    goto after_adContent;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'adContent';
                        $value = $this->hydrateCCTSDKCampaignDataAdContentAdContent($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['adContent'] = $value;
    
                after_adContent:

                $value = $payload['targeting'] ?? null;
    
                if ($value === null) {
                    $properties['targeting'] = null;
                    goto after_targeting;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'targeting';
                        $value = $this->hydrateCCTSDKCampaignDataTargetingTargeting($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['targeting'] = $value;
    
                after_targeting:

                $value = $payload['options'] ?? null;
    
                if ($value === null) {
                    $properties['options'] = null;
                    goto after_options;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'options';
                        $value = $this->hydrateCCTSDKCampaignDataOptionsOptions($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['options'] = $value;
    
                after_options:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Payload\SaveCampaign', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Payload\SaveCampaign::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Payload\SaveCampaign(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Payload\SaveCampaign', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignPayloadStartCampaign(array $payload): \CCT\SDK\Campaign\Payload\StartCampaign
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['campaign_flow_uuid'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'campaign_flow_uuid';
                    goto after_campaignFlowUuid;
                }

                static $campaignFlowUuidCaster1;
    
                if ($campaignFlowUuidCaster1 === null) {
                    $campaignFlowUuidCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\CampaignFlow\\Data\\CampaignFlowId',
));
                }
    
                $value = $campaignFlowUuidCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'campaignFlowUuid';
                        $value = $this->hydrateCCTSDKCampaignFlowDataCampaignFlowId($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['campaignFlowUuid'] = $value;
    
                after_campaignFlowUuid:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Payload\StartCampaign', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Payload\StartCampaign::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Payload\StartCampaign(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Payload\StartCampaign', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCampaignResponseCommonMutateResponse(array $payload): \CCT\SDK\Campaign\Response\CommonMutateResponse
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['uuid'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'uuid';
                    goto after_campaignId;
                }

                static $campaignIdCaster1;
    
                if ($campaignIdCaster1 === null) {
                    $campaignIdCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\CampaignId',
));
                }
    
                $value = $campaignIdCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'campaignId';
                        $value = $this->hydrateCCTSDKCampaignDataCampaignId($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['campaignId'] = $value;
    
                after_campaignId:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Response\CommonMutateResponse', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Campaign\Response\CommonMutateResponse::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Campaign\Response\CommonMutateResponse(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Campaign\Response\CommonMutateResponse', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCustomerDataAgencyId(array $payload): \CCT\SDK\Customer\Data\AgencyId
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['value'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'value';
                    goto after_value;
                }

                static $valueCaster1;
    
                if ($valueCaster1 === null) {
                    $valueCaster1 = new \EventSauce\ObjectHydrator\PropertyCasters\CastToUuid(...array (
));
                }
    
                $value = $valueCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'value';
                        $value = $this->hydrateRamseyUuidUuidInterface($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['value'] = $value;
    
                after_value:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Customer\Data\AgencyId', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Customer\Data\AgencyId::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Customer\Data\AgencyId(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Customer\Data\AgencyId', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCustomerDataCustomerId(array $payload): \CCT\SDK\Customer\Data\CustomerId
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['value'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'value';
                    goto after_value;
                }

                static $valueCaster1;
    
                if ($valueCaster1 === null) {
                    $valueCaster1 = new \EventSauce\ObjectHydrator\PropertyCasters\CastToUuid(...array (
));
                }
    
                $value = $valueCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'value';
                        $value = $this->hydrateRamseyUuidUuidInterface($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['value'] = $value;
    
                after_value:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Customer\Data\CustomerId', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Customer\Data\CustomerId::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Customer\Data\CustomerId(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Customer\Data\CustomerId', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCustomerDataName(array $payload): \CCT\SDK\Customer\Data\Name
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['value'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'value';
                    goto after_value;
                }

                $properties['value'] = $value;
    
                after_value:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Customer\Data\Name', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Customer\Data\Name::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Customer\Data\Name(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Customer\Data\Name', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCustomerResponseListResult(array $payload): \CCT\SDK\Customer\Response\ListResult
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['items'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'items';
                    goto after_items;
                }

                if (is_array($value[array_key_first($value)] ?? false)) {
                    try {
                        $this->hydrationStack[] = 'items';
                        $value = $this->hydrateObjects('CCT\SDK\Customer\Response\List\Agency', $value)->toArray();
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['items'] = $value;
    
                after_items:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Customer\Response\ListResult', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Customer\Response\ListResult::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Customer\Response\ListResult(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Customer\Response\ListResult', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCustomerResponseListAgency(array $payload): \CCT\SDK\Customer\Response\List\Agency
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['id'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'id';
                    goto after_id;
                }

                static $idCaster1;
    
                if ($idCaster1 === null) {
                    $idCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Customer\\Data\\AgencyId',
));
                }
    
                $value = $idCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'id';
                        $value = $this->hydrateCCTSDKCustomerDataAgencyId($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['id'] = $value;
    
                after_id:

                $value = $payload['name'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'name';
                    goto after_name;
                }

                static $nameCaster1;
    
                if ($nameCaster1 === null) {
                    $nameCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Customer\\Data\\Name',
));
                }
    
                $value = $nameCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'name';
                        $value = $this->hydrateCCTSDKCustomerDataName($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['name'] = $value;
    
                after_name:

                $value = $payload['trading_name'] ?? null;
    
                if ($value === null) {
                    $properties['tradingName'] = null;
                    goto after_tradingName;
                }

                static $tradingNameCaster1;
    
                if ($tradingNameCaster1 === null) {
                    $tradingNameCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Customer\\Data\\Name',
));
                }
    
                $value = $tradingNameCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'tradingName';
                        $value = $this->hydrateCCTSDKCustomerDataName($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['tradingName'] = $value;
    
                after_tradingName:

                $value = $payload['customers'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'customers';
                    goto after_customers;
                }

                static $customersCaster1;
    
                if ($customersCaster1 === null) {
                    $customersCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Customer\\Response\\List\\Customers',
));
                }
    
                $value = $customersCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'customers';
                        $value = $this->hydrateCCTSDKCustomerResponseListCustomers($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['customers'] = $value;
    
                after_customers:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Customer\Response\List\Agency', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Customer\Response\List\Agency::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Customer\Response\List\Agency(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Customer\Response\List\Agency', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCustomerResponseListCustomer(array $payload): \CCT\SDK\Customer\Response\List\Customer
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['id'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'id';
                    goto after_id;
                }

                static $idCaster1;
    
                if ($idCaster1 === null) {
                    $idCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Customer\\Data\\CustomerId',
));
                }
    
                $value = $idCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'id';
                        $value = $this->hydrateCCTSDKCustomerDataCustomerId($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['id'] = $value;
    
                after_id:

                $value = $payload['name'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'name';
                    goto after_name;
                }

                static $nameCaster1;
    
                if ($nameCaster1 === null) {
                    $nameCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Customer\\Data\\Name',
));
                }
    
                $value = $nameCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'name';
                        $value = $this->hydrateCCTSDKCustomerDataName($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['name'] = $value;
    
                after_name:

                $value = $payload['trading_name'] ?? null;
    
                if ($value === null) {
                    $properties['tradingName'] = null;
                    goto after_tradingName;
                }

                static $tradingNameCaster1;
    
                if ($tradingNameCaster1 === null) {
                    $tradingNameCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Customer\\Data\\Name',
));
                }
    
                $value = $tradingNameCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'tradingName';
                        $value = $this->hydrateCCTSDKCustomerDataName($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['tradingName'] = $value;
    
                after_tradingName:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Customer\Response\List\Customer', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Customer\Response\List\Customer::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Customer\Response\List\Customer(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Customer\Response\List\Customer', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKCustomerResponseListCustomers(array $payload): \CCT\SDK\Customer\Response\List\Customers
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['items'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'items';
                    goto after_items;
                }

                if (is_array($value[array_key_first($value)] ?? false)) {
                    try {
                        $this->hydrationStack[] = 'items';
                        $value = $this->hydrateObjects('CCT\SDK\Customer\Response\List\Customer', $value)->toArray();
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['items'] = $value;
    
                after_items:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Customer\Response\List\Customers', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Customer\Response\List\Customers::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Customer\Response\List\Customers(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Customer\Response\List\Customers', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKMediaManagementRequestContextContext(array $payload): \CCT\SDK\MediaManagement\Request\Context\Context
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['name'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'name';
                    goto after_name;
                }

                $properties['name'] = $value;
    
                after_name:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\Request\Context\Context', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\MediaManagement\Request\Context\Context::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\MediaManagement\Request\Context\Context(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\Request\Context\Context', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKMediaManagementRequestMediaBaseMediaCreate(array $payload): \CCT\SDK\MediaManagement\Request\Media\BaseMediaCreate
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['id'] ?? null;
    
                if ($value === null) {
                    $properties['id'] = null;
                    goto after_id;
                }

                $properties['id'] = $value;
    
                after_id:

                $value = $payload['name'] ?? null;
    
                if ($value === null) {
                    $properties['name'] = null;
                    goto after_name;
                }

                $properties['name'] = $value;
    
                after_name:

                $value = $payload['description'] ?? null;
    
                if ($value === null) {
                    $properties['description'] = null;
                    goto after_description;
                }

                $properties['description'] = $value;
    
                after_description:

                $value = $payload['private'] ?? null;
    
                if ($value === null) {
                    $properties['private'] = null;
                    goto after_private;
                }

                $properties['private'] = $value;
    
                after_private:

                $value = $payload['type'] ?? null;
    
                if ($value === null) {
                    $properties['type'] = null;
                    goto after_type;
                }

                $value = \CCT\SDK\MediaManagement\ViewModel\MediaType::from($value);

                $properties['type'] = $value;
    
                after_type:

                $value = $payload['predefined_name'] ?? null;
    
                if ($value === null) {
                    $properties['predefinedName'] = null;
                    goto after_predefinedName;
                }

                $properties['predefinedName'] = $value;
    
                after_predefinedName:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\Request\Media\BaseMediaCreate', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\MediaManagement\Request\Media\BaseMediaCreate::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\MediaManagement\Request\Media\BaseMediaCreate(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\Request\Media\BaseMediaCreate', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKMediaManagementRequestMediaCreateMediaCollection(array $payload): \CCT\SDK\MediaManagement\Request\Media\CreateMediaCollection
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['items'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'items';
                    goto after_items;
                }

                static $itemsCaster1;
    
                if ($itemsCaster1 === null) {
                    $itemsCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastListUnionToType(...array (
  0 => 
  array (
    'remote_file' => 'CCT\\SDK\\MediaManagement\\Request\\Media\\RemoteMedia',
    'external_url' => 'CCT\\SDK\\MediaManagement\\Request\\Media\\ExternalMedia',
    'file_resource' => 'CCT\\SDK\\MediaManagement\\Request\\Media\\UploadMedia',
  ),
));
                }
    
                $value = $itemsCaster1->cast($value, $this);

                $properties['items'] = $value;
    
                after_items:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\Request\Media\CreateMediaCollection', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\MediaManagement\Request\Media\CreateMediaCollection::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\MediaManagement\Request\Media\CreateMediaCollection(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\Request\Media\CreateMediaCollection', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKMediaManagementRequestMediaExternalMedia(array $payload): \CCT\SDK\MediaManagement\Request\Media\ExternalMedia
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = [];
    
                
                $to = $payload['id'] ?? null;
    
                if ($to !== null) {
                    $value['id'] = $to;
                }

                $to = $payload['name'] ?? null;
    
                if ($to !== null) {
                    $value['name'] = $to;
                }

                $to = $payload['description'] ?? null;
    
                if ($to !== null) {
                    $value['description'] = $to;
                }

                $to = $payload['private'] ?? null;
    
                if ($to !== null) {
                    $value['private'] = $to;
                }

                $to = $payload['type'] ?? null;
    
                if ($to !== null) {
                    $value['type'] = $to;
                }

                $to = $payload['predefined_name'] ?? null;
    
                if ($to !== null) {
                    $value['predefined_name'] = $to;
                }

    
                if ($value === []) {
                    goto after_baseMediaCreate;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'baseMediaCreate';
                        $value = $this->hydrateCCTSDKMediaManagementRequestMediaBaseMediaCreate($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['baseMediaCreate'] = $value;
    
                after_baseMediaCreate:

                $value = $payload['external_url'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'external_url';
                    goto after_externalUrl;
                }

                $properties['externalUrl'] = $value;
    
                after_externalUrl:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\Request\Media\ExternalMedia', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\MediaManagement\Request\Media\ExternalMedia::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\MediaManagement\Request\Media\ExternalMedia(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\Request\Media\ExternalMedia', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKMediaManagementRequestMediaMediaId(array $payload): \CCT\SDK\MediaManagement\Request\Media\MediaId
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['value'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'value';
                    goto after_value;
                }

                static $valueCaster1;
    
                if ($valueCaster1 === null) {
                    $valueCaster1 = new \EventSauce\ObjectHydrator\PropertyCasters\CastToUuid(...array (
));
                }
    
                $value = $valueCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'value';
                        $value = $this->hydrateRamseyUuidUuidInterface($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['value'] = $value;
    
                after_value:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\Request\Media\MediaId', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\MediaManagement\Request\Media\MediaId::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\MediaManagement\Request\Media\MediaId(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\Request\Media\MediaId', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKMediaManagementRequestMediaMediaIdCollection(array $payload): \CCT\SDK\MediaManagement\Request\Media\MediaIdCollection
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['items'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'items';
                    goto after_items;
                }

                if (is_array($value[array_key_first($value)] ?? false)) {
                    try {
                        $this->hydrationStack[] = 'items';
                        $value = $this->hydrateObjects('CCT\SDK\MediaManagement\Request\Media\MediaId', $value)->toArray();
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['items'] = $value;
    
                after_items:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\Request\Media\MediaIdCollection', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\MediaManagement\Request\Media\MediaIdCollection::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\MediaManagement\Request\Media\MediaIdCollection(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\Request\Media\MediaIdCollection', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKMediaManagementRequestMediaMediaTypeCollection(array $payload): \CCT\SDK\MediaManagement\Request\Media\MediaTypeCollection
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['items'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'items';
                    goto after_items;
                }

                $value = \CCT\SDK\MediaManagement\ViewModel\MediaType::from($value);

                $properties['items'] = $value;
    
                after_items:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\Request\Media\MediaTypeCollection', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\MediaManagement\Request\Media\MediaTypeCollection::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\MediaManagement\Request\Media\MediaTypeCollection(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\Request\Media\MediaTypeCollection', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKMediaManagementRequestMediaRemoteMedia(array $payload): \CCT\SDK\MediaManagement\Request\Media\RemoteMedia
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = [];
    
                
                $to = $payload['id'] ?? null;
    
                if ($to !== null) {
                    $value['id'] = $to;
                }

                $to = $payload['name'] ?? null;
    
                if ($to !== null) {
                    $value['name'] = $to;
                }

                $to = $payload['description'] ?? null;
    
                if ($to !== null) {
                    $value['description'] = $to;
                }

                $to = $payload['private'] ?? null;
    
                if ($to !== null) {
                    $value['private'] = $to;
                }

                $to = $payload['type'] ?? null;
    
                if ($to !== null) {
                    $value['type'] = $to;
                }

                $to = $payload['predefined_name'] ?? null;
    
                if ($to !== null) {
                    $value['predefined_name'] = $to;
                }

    
                if ($value === []) {
                    goto after_baseMediaCreate;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'baseMediaCreate';
                        $value = $this->hydrateCCTSDKMediaManagementRequestMediaBaseMediaCreate($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['baseMediaCreate'] = $value;
    
                after_baseMediaCreate:

                $value = $payload['remote_file'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'remote_file';
                    goto after_remoteFile;
                }

                $properties['remoteFile'] = $value;
    
                after_remoteFile:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\Request\Media\RemoteMedia', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\MediaManagement\Request\Media\RemoteMedia::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\MediaManagement\Request\Media\RemoteMedia(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\Request\Media\RemoteMedia', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKMediaManagementRequestMediaStatusCollection(array $payload): \CCT\SDK\MediaManagement\Request\Media\StatusCollection
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['items'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'items';
                    goto after_items;
                }

                $value = \CCT\SDK\MediaManagement\ViewModel\Status::from($value);

                $properties['items'] = $value;
    
                after_items:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\Request\Media\StatusCollection', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\MediaManagement\Request\Media\StatusCollection::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\MediaManagement\Request\Media\StatusCollection(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\Request\Media\StatusCollection', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKMediaManagementRequestMediaUploadMedia(array $payload): \CCT\SDK\MediaManagement\Request\Media\UploadMedia
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = [];
    
                
                $to = $payload['id'] ?? null;
    
                if ($to !== null) {
                    $value['id'] = $to;
                }

                $to = $payload['name'] ?? null;
    
                if ($to !== null) {
                    $value['name'] = $to;
                }

                $to = $payload['description'] ?? null;
    
                if ($to !== null) {
                    $value['description'] = $to;
                }

                $to = $payload['private'] ?? null;
    
                if ($to !== null) {
                    $value['private'] = $to;
                }

                $to = $payload['type'] ?? null;
    
                if ($to !== null) {
                    $value['type'] = $to;
                }

                $to = $payload['predefined_name'] ?? null;
    
                if ($to !== null) {
                    $value['predefined_name'] = $to;
                }

    
                if ($value === []) {
                    goto after_baseMediaCreate;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'baseMediaCreate';
                        $value = $this->hydrateCCTSDKMediaManagementRequestMediaBaseMediaCreate($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['baseMediaCreate'] = $value;
    
                after_baseMediaCreate:

                $value = $payload['file_resource'] ?? null;
    
                if ($value === null) {
                    $properties['fileResource'] = null;
                    goto after_fileResource;
                }

                $properties['fileResource'] = $value;
    
                after_fileResource:

                $value = $payload['file_name'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'file_name';
                    goto after_fileName;
                }

                $properties['fileName'] = $value;
    
                after_fileName:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\Request\Media\UploadMedia', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\MediaManagement\Request\Media\UploadMedia::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\MediaManagement\Request\Media\UploadMedia(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\Request\Media\UploadMedia', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKMediaManagementRequestSearchQueryParams(array $payload): \CCT\SDK\MediaManagement\Request\SearchQueryParams
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['limit'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'limit';
                    goto after_limit;
                }

                $properties['limit'] = $value;
    
                after_limit:

                $value = $payload['page'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'page';
                    goto after_page;
                }

                $properties['page'] = $value;
    
                after_page:

                $value = $payload['q'] ?? null;
    
                if ($value === null) {
                    $properties['q'] = null;
                    goto after_q;
                }

                $properties['q'] = $value;
    
                after_q:

                $value = $payload['types'] ?? null;
    
                if ($value === null) {
                    $properties['types'] = null;
                    goto after_types;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'types';
                        $value = $this->hydrateCCTSDKMediaManagementRequestMediaMediaTypeCollection($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['types'] = $value;
    
                after_types:

                $value = $payload['id'] ?? null;
    
                if ($value === null) {
                    $properties['id'] = null;
                    goto after_id;
                }

                $properties['id'] = $value;
    
                after_id:

                $value = $payload['sort'] ?? null;
    
                if ($value === null) {
                    $properties['sort'] = null;
                    goto after_sort;
                }

                $properties['sort'] = $value;
    
                after_sort:

                $value = $payload['direction'] ?? null;
    
                if ($value === null) {
                    $properties['direction'] = null;
                    goto after_direction;
                }

                $properties['direction'] = $value;
    
                after_direction:

                $value = $payload['statuses'] ?? null;
    
                if ($value === null) {
                    $properties['statuses'] = null;
                    goto after_statuses;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'statuses';
                        $value = $this->hydrateCCTSDKMediaManagementRequestMediaStatusCollection($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['statuses'] = $value;
    
                after_statuses:

                $value = $payload['context'] ?? null;
    
                if ($value === null) {
                    $properties['context'] = null;
                    goto after_context;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'context';
                        $value = $this->hydrateCCTSDKMediaManagementRequestContextContext($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['context'] = $value;
    
                after_context:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\Request\SearchQueryParams', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\MediaManagement\Request\SearchQueryParams::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\MediaManagement\Request\SearchQueryParams(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\Request\SearchQueryParams', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKMediaManagementViewModelBaseMedia(array $payload): \CCT\SDK\MediaManagement\ViewModel\BaseMedia
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['id'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'id';
                    goto after_id;
                }

                $properties['id'] = $value;
    
                after_id:

                $value = $payload['name'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'name';
                    goto after_name;
                }

                $properties['name'] = $value;
    
                after_name:

                $value = $payload['description'] ?? null;
    
                if ($value === null) {
                    $properties['description'] = null;
                    goto after_description;
                }

                $properties['description'] = $value;
    
                after_description:

                $value = $payload['private'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'private';
                    goto after_private;
                }

                $properties['private'] = $value;
    
                after_private:

                $value = $payload['extension'] ?? null;
    
                if ($value === null) {
                    $properties['extension'] = null;
                    goto after_extension;
                }

                $properties['extension'] = $value;
    
                after_extension:

                $value = $payload['status'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'status';
                    goto after_status;
                }

                $value = \CCT\SDK\MediaManagement\ViewModel\Status::from($value);

                $properties['status'] = $value;
    
                after_status:

                $value = $payload['external'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'external';
                    goto after_external;
                }

                $properties['external'] = $value;
    
                after_external:

                $value = $payload['contexts'] ?? null;
    
                if ($value === null) {
                    $properties['contexts'] = null;
                    goto after_contexts;
                }

                static $contextsCaster1;
    
                if ($contextsCaster1 === null) {
                    $contextsCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\MediaManagement\\ViewModel\\ContextCollection',
));
                }
    
                $value = $contextsCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'contexts';
                        $value = $this->hydrateCCTSDKMediaManagementViewModelContextCollection($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['contexts'] = $value;
    
                after_contexts:

                $value = $payload['type'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'type';
                    goto after_type;
                }

                $value = \CCT\SDK\MediaManagement\ViewModel\MediaType::from($value);

                $properties['type'] = $value;
    
                after_type:

                $value = $payload['endpoint'] ?? null;
    
                if ($value === null) {
                    $properties['endpoint'] = null;
                    goto after_endpoint;
                }

                $properties['endpoint'] = $value;
    
                after_endpoint:

                $value = $payload['file_format'] ?? null;
    
                if ($value === null) {
                    $properties['fileFormat'] = null;
                    goto after_fileFormat;
                }

                $properties['fileFormat'] = $value;
    
                after_fileFormat:

                $value = $payload['original_uri'] ?? null;
    
                if ($value === null) {
                    $properties['originalUri'] = null;
                    goto after_originalUri;
                }

                $properties['originalUri'] = $value;
    
                after_originalUri:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\ViewModel\BaseMedia', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\MediaManagement\ViewModel\BaseMedia::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\MediaManagement\ViewModel\BaseMedia(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\ViewModel\BaseMedia', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKMediaManagementViewModelContext(array $payload): \CCT\SDK\MediaManagement\ViewModel\Context
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['id'] ?? null;
    
                if ($value === null) {
                    $properties['id'] = null;
                    goto after_id;
                }

                $properties['id'] = $value;
    
                after_id:

                $value = $payload['name'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'name';
                    goto after_name;
                }

                $properties['name'] = $value;
    
                after_name:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\ViewModel\Context', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\MediaManagement\ViewModel\Context::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\MediaManagement\ViewModel\Context(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\ViewModel\Context', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKMediaManagementViewModelContextCollection(array $payload): \CCT\SDK\MediaManagement\ViewModel\ContextCollection
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['items'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'items';
                    goto after_items;
                }

                if (is_array($value[array_key_first($value)] ?? false)) {
                    try {
                        $this->hydrationStack[] = 'items';
                        $value = $this->hydrateObjects('CCT\SDK\MediaManagement\ViewModel\Context', $value)->toArray();
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['items'] = $value;
    
                after_items:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\ViewModel\ContextCollection', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\MediaManagement\ViewModel\ContextCollection::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\MediaManagement\ViewModel\ContextCollection(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\ViewModel\ContextCollection', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKMediaManagementViewModelMediaAudio(array $payload): \CCT\SDK\MediaManagement\ViewModel\MediaAudio
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = [];
    
                
                $to = $payload['id'] ?? null;
    
                if ($to !== null) {
                    $value['id'] = $to;
                }

                $to = $payload['name'] ?? null;
    
                if ($to !== null) {
                    $value['name'] = $to;
                }

                $to = $payload['description'] ?? null;
    
                if ($to !== null) {
                    $value['description'] = $to;
                }

                $to = $payload['private'] ?? null;
    
                if ($to !== null) {
                    $value['private'] = $to;
                }

                $to = $payload['extension'] ?? null;
    
                if ($to !== null) {
                    $value['extension'] = $to;
                }

                $to = $payload['status'] ?? null;
    
                if ($to !== null) {
                    $value['status'] = $to;
                }

                $to = $payload['external'] ?? null;
    
                if ($to !== null) {
                    $value['external'] = $to;
                }

                $to = $payload['contexts'] ?? null;
    
                if ($to !== null) {
                    $value['contexts'] = $to;
                }

                $to = $payload['type'] ?? null;
    
                if ($to !== null) {
                    $value['type'] = $to;
                }

                $to = $payload['endpoint'] ?? null;
    
                if ($to !== null) {
                    $value['endpoint'] = $to;
                }

                $to = $payload['file_format'] ?? null;
    
                if ($to !== null) {
                    $value['file_format'] = $to;
                }

                $to = $payload['original_uri'] ?? null;
    
                if ($to !== null) {
                    $value['original_uri'] = $to;
                }

    
                if ($value === []) {
                    goto after_baseMedia;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'baseMedia';
                        $value = $this->hydrateCCTSDKMediaManagementViewModelBaseMedia($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['baseMedia'] = $value;
    
                after_baseMedia:

                $value = $payload['content_size'] ?? null;
    
                if ($value === null) {
                    $properties['contentSize'] = null;
                    goto after_contentSize;
                }

                $properties['contentSize'] = $value;
    
                after_contentSize:

                $value = $payload['duration'] ?? null;
    
                if ($value === null) {
                    $properties['duration'] = null;
                    goto after_duration;
                }

                $properties['duration'] = $value;
    
                after_duration:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\ViewModel\MediaAudio', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\MediaManagement\ViewModel\MediaAudio::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\MediaManagement\ViewModel\MediaAudio(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\ViewModel\MediaAudio', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKMediaManagementViewModelMediaCollection(array $payload): \CCT\SDK\MediaManagement\ViewModel\MediaCollection
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['items'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'items';
                    goto after_items;
                }

                static $itemsCaster1;
    
                if ($itemsCaster1 === null) {
                    $itemsCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastListUnionToType(...array (
  0 => 
  array (
    'image' => 'CCT\\SDK\\MediaManagement\\ViewModel\\MediaImage',
    'video' => 'CCT\\SDK\\MediaManagement\\ViewModel\\MediaVideo',
    'document' => 'CCT\\SDK\\MediaManagement\\ViewModel\\MediaDocument',
    'audio' => 'CCT\\SDK\\MediaManagement\\ViewModel\\MediaAudio',
  ),
));
                }
    
                $value = $itemsCaster1->cast($value, $this);

                $properties['items'] = $value;
    
                after_items:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\ViewModel\MediaCollection', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\MediaManagement\ViewModel\MediaCollection::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\MediaManagement\ViewModel\MediaCollection(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\ViewModel\MediaCollection', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKMediaManagementViewModelMediaDocument(array $payload): \CCT\SDK\MediaManagement\ViewModel\MediaDocument
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = [];
    
                
                $to = $payload['id'] ?? null;
    
                if ($to !== null) {
                    $value['id'] = $to;
                }

                $to = $payload['name'] ?? null;
    
                if ($to !== null) {
                    $value['name'] = $to;
                }

                $to = $payload['description'] ?? null;
    
                if ($to !== null) {
                    $value['description'] = $to;
                }

                $to = $payload['private'] ?? null;
    
                if ($to !== null) {
                    $value['private'] = $to;
                }

                $to = $payload['extension'] ?? null;
    
                if ($to !== null) {
                    $value['extension'] = $to;
                }

                $to = $payload['status'] ?? null;
    
                if ($to !== null) {
                    $value['status'] = $to;
                }

                $to = $payload['external'] ?? null;
    
                if ($to !== null) {
                    $value['external'] = $to;
                }

                $to = $payload['contexts'] ?? null;
    
                if ($to !== null) {
                    $value['contexts'] = $to;
                }

                $to = $payload['type'] ?? null;
    
                if ($to !== null) {
                    $value['type'] = $to;
                }

                $to = $payload['endpoint'] ?? null;
    
                if ($to !== null) {
                    $value['endpoint'] = $to;
                }

                $to = $payload['file_format'] ?? null;
    
                if ($to !== null) {
                    $value['file_format'] = $to;
                }

                $to = $payload['original_uri'] ?? null;
    
                if ($to !== null) {
                    $value['original_uri'] = $to;
                }

    
                if ($value === []) {
                    goto after_baseMedia;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'baseMedia';
                        $value = $this->hydrateCCTSDKMediaManagementViewModelBaseMedia($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['baseMedia'] = $value;
    
                after_baseMedia:

                $value = $payload['content_size'] ?? null;
    
                if ($value === null) {
                    $properties['contentSize'] = null;
                    goto after_contentSize;
                }

                $properties['contentSize'] = $value;
    
                after_contentSize:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\ViewModel\MediaDocument', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\MediaManagement\ViewModel\MediaDocument::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\MediaManagement\ViewModel\MediaDocument(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\ViewModel\MediaDocument', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKMediaManagementViewModelMediaImage(array $payload): \CCT\SDK\MediaManagement\ViewModel\MediaImage
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = [];
    
                
                $to = $payload['id'] ?? null;
    
                if ($to !== null) {
                    $value['id'] = $to;
                }

                $to = $payload['name'] ?? null;
    
                if ($to !== null) {
                    $value['name'] = $to;
                }

                $to = $payload['description'] ?? null;
    
                if ($to !== null) {
                    $value['description'] = $to;
                }

                $to = $payload['private'] ?? null;
    
                if ($to !== null) {
                    $value['private'] = $to;
                }

                $to = $payload['extension'] ?? null;
    
                if ($to !== null) {
                    $value['extension'] = $to;
                }

                $to = $payload['status'] ?? null;
    
                if ($to !== null) {
                    $value['status'] = $to;
                }

                $to = $payload['external'] ?? null;
    
                if ($to !== null) {
                    $value['external'] = $to;
                }

                $to = $payload['contexts'] ?? null;
    
                if ($to !== null) {
                    $value['contexts'] = $to;
                }

                $to = $payload['type'] ?? null;
    
                if ($to !== null) {
                    $value['type'] = $to;
                }

                $to = $payload['endpoint'] ?? null;
    
                if ($to !== null) {
                    $value['endpoint'] = $to;
                }

                $to = $payload['file_format'] ?? null;
    
                if ($to !== null) {
                    $value['file_format'] = $to;
                }

                $to = $payload['original_uri'] ?? null;
    
                if ($to !== null) {
                    $value['original_uri'] = $to;
                }

    
                if ($value === []) {
                    goto after_baseMedia;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'baseMedia';
                        $value = $this->hydrateCCTSDKMediaManagementViewModelBaseMedia($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['baseMedia'] = $value;
    
                after_baseMedia:

                $value = $payload['content_size'] ?? null;
    
                if ($value === null) {
                    $properties['contentSize'] = null;
                    goto after_contentSize;
                }

                $properties['contentSize'] = $value;
    
                after_contentSize:

                $value = $payload['width'] ?? null;
    
                if ($value === null) {
                    $properties['width'] = null;
                    goto after_width;
                }

                $properties['width'] = $value;
    
                after_width:

                $value = $payload['height'] ?? null;
    
                if ($value === null) {
                    $properties['height'] = null;
                    goto after_height;
                }

                $properties['height'] = $value;
    
                after_height:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\ViewModel\MediaImage', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\MediaManagement\ViewModel\MediaImage::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\MediaManagement\ViewModel\MediaImage(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\ViewModel\MediaImage', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKMediaManagementViewModelMediaVideo(array $payload): \CCT\SDK\MediaManagement\ViewModel\MediaVideo
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = [];
    
                
                $to = $payload['id'] ?? null;
    
                if ($to !== null) {
                    $value['id'] = $to;
                }

                $to = $payload['name'] ?? null;
    
                if ($to !== null) {
                    $value['name'] = $to;
                }

                $to = $payload['description'] ?? null;
    
                if ($to !== null) {
                    $value['description'] = $to;
                }

                $to = $payload['private'] ?? null;
    
                if ($to !== null) {
                    $value['private'] = $to;
                }

                $to = $payload['extension'] ?? null;
    
                if ($to !== null) {
                    $value['extension'] = $to;
                }

                $to = $payload['status'] ?? null;
    
                if ($to !== null) {
                    $value['status'] = $to;
                }

                $to = $payload['external'] ?? null;
    
                if ($to !== null) {
                    $value['external'] = $to;
                }

                $to = $payload['contexts'] ?? null;
    
                if ($to !== null) {
                    $value['contexts'] = $to;
                }

                $to = $payload['type'] ?? null;
    
                if ($to !== null) {
                    $value['type'] = $to;
                }

                $to = $payload['endpoint'] ?? null;
    
                if ($to !== null) {
                    $value['endpoint'] = $to;
                }

                $to = $payload['file_format'] ?? null;
    
                if ($to !== null) {
                    $value['file_format'] = $to;
                }

                $to = $payload['original_uri'] ?? null;
    
                if ($to !== null) {
                    $value['original_uri'] = $to;
                }

    
                if ($value === []) {
                    goto after_baseMedia;
                }

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'baseMedia';
                        $value = $this->hydrateCCTSDKMediaManagementViewModelBaseMedia($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['baseMedia'] = $value;
    
                after_baseMedia:

                $value = $payload['content_size'] ?? null;
    
                if ($value === null) {
                    $properties['contentSize'] = null;
                    goto after_contentSize;
                }

                $properties['contentSize'] = $value;
    
                after_contentSize:

                $value = $payload['width'] ?? null;
    
                if ($value === null) {
                    $properties['width'] = null;
                    goto after_width;
                }

                $properties['width'] = $value;
    
                after_width:

                $value = $payload['height'] ?? null;
    
                if ($value === null) {
                    $properties['height'] = null;
                    goto after_height;
                }

                $properties['height'] = $value;
    
                after_height:

                $value = $payload['duration'] ?? null;
    
                if ($value === null) {
                    $properties['duration'] = null;
                    goto after_duration;
                }

                $properties['duration'] = $value;
    
                after_duration:

                $value = $payload['frame_rate'] ?? null;
    
                if ($value === null) {
                    $properties['frameRate'] = null;
                    goto after_frameRate;
                }

                $properties['frameRate'] = $value;
    
                after_frameRate:

                $value = $payload['poster_url'] ?? null;
    
                if ($value === null) {
                    $properties['posterUrl'] = null;
                    goto after_posterUrl;
                }

                $properties['posterUrl'] = $value;
    
                after_posterUrl:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\ViewModel\MediaVideo', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\MediaManagement\ViewModel\MediaVideo::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\MediaManagement\ViewModel\MediaVideo(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\ViewModel\MediaVideo', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKMediaManagementViewModelSearchResult(array $payload): \CCT\SDK\MediaManagement\ViewModel\SearchResult
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['total'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'total';
                    goto after_total;
                }

                $properties['total'] = $value;
    
                after_total:

                $value = $payload['data'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'data';
                    goto after_data;
                }

                static $dataCaster1;
    
                if ($dataCaster1 === null) {
                    $dataCaster1 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\MediaManagement\\ViewModel\\MediaCollection',
));
                }
    
                $value = $dataCaster1->cast($value, $this);

                if (is_array($value)) {
                    try {
                        $this->hydrationStack[] = 'data';
                        $value = $this->hydrateCCTSDKMediaManagementViewModelMediaCollection($value);
                    } finally {
                        array_pop($this->hydrationStack);
                    }
                }

                $properties['data'] = $value;
    
                after_data:

                $value = $payload['page'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'page';
                    goto after_page;
                }

                $properties['page'] = $value;
    
                after_page:

                $value = $payload['items_per_page'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'items_per_page';
                    goto after_itemsPerPage;
                }

                $properties['itemsPerPage'] = $value;
    
                after_itemsPerPage:

                $value = $payload['page_count'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'page_count';
                    goto after_pageCount;
                }

                $properties['pageCount'] = $value;
    
                after_pageCount:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\ViewModel\SearchResult', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\MediaManagement\ViewModel\SearchResult::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\MediaManagement\ViewModel\SearchResult(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\MediaManagement\ViewModel\SearchResult', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKInfrastructureValueObjectEnabled(array $payload): \CCT\SDK\Infrastructure\ValueObject\Enabled
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['value'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'value';
                    goto after_value;
                }

                $properties['value'] = $value;
    
                after_value:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Infrastructure\ValueObject\Enabled', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Infrastructure\ValueObject\Enabled::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Infrastructure\ValueObject\Enabled(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Infrastructure\ValueObject\Enabled', $exception, stack: $this->hydrationStack);
            }
        }

        
        private function hydrateCCTSDKInfrastructureValueObjectUri(array $payload): \CCT\SDK\Infrastructure\ValueObject\Uri
        {
            $properties = []; 
            $missingFields = [];
            try {
                
                $value = $payload['value'] ?? null;
    
                if ($value === null) {
                    $missingFields[] = 'value';
                    goto after_value;
                }

                $properties['value'] = $value;
    
                after_value:

            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Infrastructure\ValueObject\Uri', $exception, stack: $this->hydrationStack);
            }
            
            if (count($missingFields) > 0) {
                throw UnableToHydrateObject::dueToMissingFields(\CCT\SDK\Infrastructure\ValueObject\Uri::class, $missingFields, stack: $this->hydrationStack);
            }
            
            try {
                return new \CCT\SDK\Infrastructure\ValueObject\Uri(...$properties);
            } catch (\Throwable $exception) {
                throw UnableToHydrateObject::dueToError('CCT\SDK\Infrastructure\ValueObject\Uri', $exception, stack: $this->hydrationStack);
            }
        }
    
    public function serializeObject(object $object): mixed
    {
        try {
            $className = get_class($object);

            return match($className) {
                'array' => $this->serializeValuearray($object),
                'Ramsey\Uuid\UuidInterface' => $this->serializeValueRamseyUuidUuidInterface($object),
                'DateTime' => $this->serializeValueDateTime($object),
                'DateTimeImmutable' => $this->serializeValueDateTimeImmutable($object),
                'DateTimeInterface' => $this->serializeValueDateTimeInterface($object),
                'CCT\SDK\Analytics\Response\Analytics' => $this->serializeObjectCCTSDKAnalyticsResponseAnalytics($object),
                'CCT\SDK\Analytics\Response\Analytics\Clicks' => $this->serializeObjectCCTSDKAnalyticsResponseAnalyticsClicks($object),
                'CCT\SDK\Analytics\Response\Analytics\Facebook' => $this->serializeObjectCCTSDKAnalyticsResponseAnalyticsFacebook($object),
                'CCT\SDK\Analytics\Response\Analytics\Impressions' => $this->serializeObjectCCTSDKAnalyticsResponseAnalyticsImpressions($object),
                'CCT\SDK\Analytics\Response\Analytics\Reach' => $this->serializeObjectCCTSDKAnalyticsResponseAnalyticsReach($object),
                'CCT\SDK\Analytics\Response\Analytics\Readers' => $this->serializeObjectCCTSDKAnalyticsResponseAnalyticsReaders($object),
                'CCT\SDK\Analytics\Response\Analytics\Target' => $this->serializeObjectCCTSDKAnalyticsResponseAnalyticsTarget($object),
                'CCT\SDK\Analytics\Response\CampaignAnalytics' => $this->serializeObjectCCTSDKAnalyticsResponseCampaignAnalytics($object),
                'CCT\SDK\Analytics\Response\Customer' => $this->serializeObjectCCTSDKAnalyticsResponseCustomer($object),
                'CCT\SDK\Analytics\Response\Period' => $this->serializeObjectCCTSDKAnalyticsResponsePeriod($object),
                'CCT\SDK\CampaignFlow\Data\CampaignFlowId' => $this->serializeObjectCCTSDKCampaignFlowDataCampaignFlowId($object),
                'CCT\SDK\CampaignFlow\Data\Currency' => $this->serializeObjectCCTSDKCampaignFlowDataCurrency($object),
                'CCT\SDK\CampaignFlow\Data\ExcludeVat' => $this->serializeObjectCCTSDKCampaignFlowDataExcludeVat($object),
                'CCT\SDK\CampaignFlow\Data\Pricing' => $this->serializeObjectCCTSDKCampaignFlowDataPricing($object),
                'CCT\SDK\CampaignFlow\Data\PricingItem' => $this->serializeObjectCCTSDKCampaignFlowDataPricingItem($object),
                'CCT\SDK\CampaignFlow\Data\Settings' => $this->serializeObjectCCTSDKCampaignFlowDataSettings($object),
                'CCT\SDK\CampaignFlow\Data\Vat' => $this->serializeObjectCCTSDKCampaignFlowDataVat($object),
                'CCT\SDK\CampaignFlow\Response\CampaignFlowItem' => $this->serializeObjectCCTSDKCampaignFlowResponseCampaignFlowItem($object),
                'CCT\SDK\CampaignFlow\Response\ListResponse' => $this->serializeObjectCCTSDKCampaignFlowResponseListResponse($object),
                'CCT\SDK\Campaign\Data\AdContent\AdContent' => $this->serializeObjectCCTSDKCampaignDataAdContentAdContent($object),
                'CCT\SDK\Campaign\Data\AdContent\AdText' => $this->serializeObjectCCTSDKCampaignDataAdContentAdText($object),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel\FacebookCarouselCard' => $this->serializeObjectCCTSDKCampaignDataAdContentAdVariantFacebookCarouselFacebookCarouselCard($object),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel\FacebookCarouselCardCollection' => $this->serializeObjectCCTSDKCampaignDataAdContentAdVariantFacebookCarouselFacebookCarouselCardCollection($object),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel\FacebookCarouselVariant' => $this->serializeObjectCCTSDKCampaignDataAdContentAdVariantFacebookCarouselFacebookCarouselVariant($object),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel\FacebookCarouselVariants' => $this->serializeObjectCCTSDKCampaignDataAdContentAdVariantFacebookCarouselFacebookCarouselVariants($object),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\Description' => $this->serializeObjectCCTSDKCampaignDataAdContentAdVariantFacebookAiMultiVariantPartDescription($object),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\DescriptionCollection' => $this->serializeObjectCCTSDKCampaignDataAdContentAdVariantFacebookAiMultiVariantPartDescriptionCollection($object),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\Heading' => $this->serializeObjectCCTSDKCampaignDataAdContentAdVariantFacebookAiMultiVariantPartHeading($object),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\HeadingCollection' => $this->serializeObjectCCTSDKCampaignDataAdContentAdVariantFacebookAiMultiVariantPartHeadingCollection($object),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\Text' => $this->serializeObjectCCTSDKCampaignDataAdContentAdVariantFacebookAiMultiVariantPartText($object),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\TextCollection' => $this->serializeObjectCCTSDKCampaignDataAdContentAdVariantFacebookAiMultiVariantPartTextCollection($object),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\FacebookAiMultiAdVariant' => $this->serializeObjectCCTSDKCampaignDataAdContentAdVariantFacebookFacebookAiMultiAdVariant($object),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\FacebookAiMultiAdVariants' => $this->serializeObjectCCTSDKCampaignDataAdContentAdVariantFacebookFacebookAiMultiAdVariants($object),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleAdVariant' => $this->serializeObjectCCTSDKCampaignDataAdContentAdVariantGoogleGoogleAdVariant($object),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleAdVariants' => $this->serializeObjectCCTSDKCampaignDataAdContentAdVariantGoogleGoogleAdVariants($object),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleResponsiveAdVariant' => $this->serializeObjectCCTSDKCampaignDataAdContentAdVariantGoogleGoogleResponsiveAdVariant($object),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleResponsiveAdVariants' => $this->serializeObjectCCTSDKCampaignDataAdContentAdVariantGoogleGoogleResponsiveAdVariants($object),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\Description' => $this->serializeObjectCCTSDKCampaignDataAdContentAdVariantGoogleResponsiveAdDescription($object),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\DescriptionCollection' => $this->serializeObjectCCTSDKCampaignDataAdContentAdVariantGoogleResponsiveAdDescriptionCollection($object),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\LongHeadline' => $this->serializeObjectCCTSDKCampaignDataAdContentAdVariantGoogleResponsiveAdLongHeadline($object),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\ShortHeadline' => $this->serializeObjectCCTSDKCampaignDataAdContentAdVariantGoogleResponsiveAdShortHeadline($object),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\ShortHeadlineCollection' => $this->serializeObjectCCTSDKCampaignDataAdContentAdVariantGoogleResponsiveAdShortHeadlineCollection($object),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\LinkedIn\LinkedInAdVariant' => $this->serializeObjectCCTSDKCampaignDataAdContentAdVariantLinkedInLinkedInAdVariant($object),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\LinkedIn\LinkedInAdVariants' => $this->serializeObjectCCTSDKCampaignDataAdContentAdVariantLinkedInLinkedInAdVariants($object),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Twitter\TwitterAdVariant' => $this->serializeObjectCCTSDKCampaignDataAdContentAdVariantTwitterTwitterAdVariant($object),
                'CCT\SDK\Campaign\Data\AdContent\AdVariant\Twitter\TwitterAdVariants' => $this->serializeObjectCCTSDKCampaignDataAdContentAdVariantTwitterTwitterAdVariants($object),
                'CCT\SDK\Campaign\Data\AdContent\CampaignImage\CampaignImages' => $this->serializeObjectCCTSDKCampaignDataAdContentCampaignImageCampaignImages($object),
                'CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\AbstractChannelImages' => $this->serializeObjectCCTSDKCampaignDataAdContentCampaignImageChannelImageAbstractChannelImages($object),
                'CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\ChannelCollection' => $this->serializeObjectCCTSDKCampaignDataAdContentCampaignImageChannelImageChannelCollection($object),
                'CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\FacebookImages' => $this->serializeObjectCCTSDKCampaignDataAdContentCampaignImageChannelImageFacebookImages($object),
                'CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\GeneralImages' => $this->serializeObjectCCTSDKCampaignDataAdContentCampaignImageChannelImageGeneralImages($object),
                'CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\GoogleImages' => $this->serializeObjectCCTSDKCampaignDataAdContentCampaignImageChannelImageGoogleImages($object),
                'CCT\SDK\Campaign\Data\AdContent\CampaignVideo\CampaignVideos' => $this->serializeObjectCCTSDKCampaignDataAdContentCampaignVideoCampaignVideos($object),
                'CCT\SDK\Campaign\Data\AdContent\Image\Image' => $this->serializeObjectCCTSDKCampaignDataAdContentImageImage($object),
                'CCT\SDK\Campaign\Data\AdContent\Image\ImageCollection' => $this->serializeObjectCCTSDKCampaignDataAdContentImageImageCollection($object),
                'CCT\SDK\Campaign\Data\AdContent\Image\ImageId' => $this->serializeObjectCCTSDKCampaignDataAdContentImageImageId($object),
                'CCT\SDK\Campaign\Data\AdContent\UserSelected' => $this->serializeObjectCCTSDKCampaignDataAdContentUserSelected($object),
                'CCT\SDK\Campaign\Data\AdContent\Video\Video' => $this->serializeObjectCCTSDKCampaignDataAdContentVideoVideo($object),
                'CCT\SDK\Campaign\Data\AdContent\Video\VideoCollection' => $this->serializeObjectCCTSDKCampaignDataAdContentVideoVideoCollection($object),
                'CCT\SDK\Campaign\Data\AdContent\Video\VideoId' => $this->serializeObjectCCTSDKCampaignDataAdContentVideoVideoId($object),
                'CCT\SDK\Campaign\Data\CampaignId' => $this->serializeObjectCCTSDKCampaignDataCampaignId($object),
                'CCT\SDK\Campaign\Data\Details\CampaignPeriod' => $this->serializeObjectCCTSDKCampaignDataDetailsCampaignPeriod($object),
                'CCT\SDK\Campaign\Data\Details\CampaignTitle' => $this->serializeObjectCCTSDKCampaignDataDetailsCampaignTitle($object),
                'CCT\SDK\Campaign\Data\Details\Details' => $this->serializeObjectCCTSDKCampaignDataDetailsDetails($object),
                'CCT\SDK\Campaign\Data\Details\LandingPage' => $this->serializeObjectCCTSDKCampaignDataDetailsLandingPage($object),
                'CCT\SDK\Campaign\Data\Options\AdvancedSlideshow' => $this->serializeObjectCCTSDKCampaignDataOptionsAdvancedSlideshow($object),
                'CCT\SDK\Campaign\Data\Options\AfterSoldAction' => $this->serializeObjectCCTSDKCampaignDataOptionsAfterSoldAction($object),
                'CCT\SDK\Campaign\Data\Options\FacebookSlideshow' => $this->serializeObjectCCTSDKCampaignDataOptionsFacebookSlideshow($object),
                'CCT\SDK\Campaign\Data\Options\LocalBoost' => $this->serializeObjectCCTSDKCampaignDataOptionsLocalBoost($object),
                'CCT\SDK\Campaign\Data\Options\NewPrice' => $this->serializeObjectCCTSDKCampaignDataOptionsNewPrice($object),
                'CCT\SDK\Campaign\Data\Options\Options' => $this->serializeObjectCCTSDKCampaignDataOptionsOptions($object),
                'CCT\SDK\Campaign\Data\Options\PostFirstVariantToFacebook' => $this->serializeObjectCCTSDKCampaignDataOptionsPostFirstVariantToFacebook($object),
                'CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Address' => $this->serializeObjectCCTSDKCampaignDataTargetingLocationTargetingAddress($object),
                'CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Coordinate' => $this->serializeObjectCCTSDKCampaignDataTargetingLocationTargetingCoordinate($object),
                'CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Country' => $this->serializeObjectCCTSDKCampaignDataTargetingLocationTargetingCountry($object),
                'CCT\SDK\Campaign\Data\Targeting\LocationTargeting\IndustryAddress' => $this->serializeObjectCCTSDKCampaignDataTargetingLocationTargetingIndustryAddress($object),
                'CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Location' => $this->serializeObjectCCTSDKCampaignDataTargetingLocationTargetingLocation($object),
                'CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Locations' => $this->serializeObjectCCTSDKCampaignDataTargetingLocationTargetingLocations($object),
                'CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Radius' => $this->serializeObjectCCTSDKCampaignDataTargetingLocationTargetingRadius($object),
                'CCT\SDK\Campaign\Data\Targeting\PropertyInformation\NumberOfBedrooms' => $this->serializeObjectCCTSDKCampaignDataTargetingPropertyInformationNumberOfBedrooms($object),
                'CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertyInformation' => $this->serializeObjectCCTSDKCampaignDataTargetingPropertyInformationPropertyInformation($object),
                'CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertyPrice' => $this->serializeObjectCCTSDKCampaignDataTargetingPropertyInformationPropertyPrice($object),
                'CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertySize' => $this->serializeObjectCCTSDKCampaignDataTargetingPropertyInformationPropertySize($object),
                'CCT\SDK\Campaign\Data\Targeting\Targeting' => $this->serializeObjectCCTSDKCampaignDataTargetingTargeting($object),
                'CCT\SDK\Campaign\Payload\CreateCampaign' => $this->serializeObjectCCTSDKCampaignPayloadCreateCampaign($object),
                'CCT\SDK\Campaign\Payload\SaveCampaign' => $this->serializeObjectCCTSDKCampaignPayloadSaveCampaign($object),
                'CCT\SDK\Campaign\Payload\StartCampaign' => $this->serializeObjectCCTSDKCampaignPayloadStartCampaign($object),
                'CCT\SDK\Campaign\Response\CommonMutateResponse' => $this->serializeObjectCCTSDKCampaignResponseCommonMutateResponse($object),
                'CCT\SDK\Customer\Data\AgencyId' => $this->serializeObjectCCTSDKCustomerDataAgencyId($object),
                'CCT\SDK\Customer\Data\CustomerId' => $this->serializeObjectCCTSDKCustomerDataCustomerId($object),
                'CCT\SDK\Customer\Data\Name' => $this->serializeObjectCCTSDKCustomerDataName($object),
                'CCT\SDK\Customer\Response\ListResult' => $this->serializeObjectCCTSDKCustomerResponseListResult($object),
                'CCT\SDK\Customer\Response\List\Agency' => $this->serializeObjectCCTSDKCustomerResponseListAgency($object),
                'CCT\SDK\Customer\Response\List\Customer' => $this->serializeObjectCCTSDKCustomerResponseListCustomer($object),
                'CCT\SDK\Customer\Response\List\Customers' => $this->serializeObjectCCTSDKCustomerResponseListCustomers($object),
                'CCT\SDK\MediaManagement\Request\Context\Context' => $this->serializeObjectCCTSDKMediaManagementRequestContextContext($object),
                'CCT\SDK\MediaManagement\Request\Media\BaseMediaCreate' => $this->serializeObjectCCTSDKMediaManagementRequestMediaBaseMediaCreate($object),
                'CCT\SDK\MediaManagement\Request\Media\CreateMediaCollection' => $this->serializeObjectCCTSDKMediaManagementRequestMediaCreateMediaCollection($object),
                'CCT\SDK\MediaManagement\Request\Media\ExternalMedia' => $this->serializeObjectCCTSDKMediaManagementRequestMediaExternalMedia($object),
                'CCT\SDK\MediaManagement\Request\Media\MediaId' => $this->serializeObjectCCTSDKMediaManagementRequestMediaMediaId($object),
                'CCT\SDK\MediaManagement\Request\Media\MediaIdCollection' => $this->serializeObjectCCTSDKMediaManagementRequestMediaMediaIdCollection($object),
                'CCT\SDK\MediaManagement\Request\Media\MediaTypeCollection' => $this->serializeObjectCCTSDKMediaManagementRequestMediaMediaTypeCollection($object),
                'CCT\SDK\MediaManagement\Request\Media\RemoteMedia' => $this->serializeObjectCCTSDKMediaManagementRequestMediaRemoteMedia($object),
                'CCT\SDK\MediaManagement\Request\Media\StatusCollection' => $this->serializeObjectCCTSDKMediaManagementRequestMediaStatusCollection($object),
                'CCT\SDK\MediaManagement\Request\Media\UploadMedia' => $this->serializeObjectCCTSDKMediaManagementRequestMediaUploadMedia($object),
                'CCT\SDK\MediaManagement\Request\SearchQueryParams' => $this->serializeObjectCCTSDKMediaManagementRequestSearchQueryParams($object),
                'CCT\SDK\MediaManagement\ViewModel\BaseMedia' => $this->serializeObjectCCTSDKMediaManagementViewModelBaseMedia($object),
                'CCT\SDK\MediaManagement\ViewModel\Context' => $this->serializeObjectCCTSDKMediaManagementViewModelContext($object),
                'CCT\SDK\MediaManagement\ViewModel\ContextCollection' => $this->serializeObjectCCTSDKMediaManagementViewModelContextCollection($object),
                'CCT\SDK\MediaManagement\ViewModel\MediaAudio' => $this->serializeObjectCCTSDKMediaManagementViewModelMediaAudio($object),
                'CCT\SDK\MediaManagement\ViewModel\MediaCollection' => $this->serializeObjectCCTSDKMediaManagementViewModelMediaCollection($object),
                'CCT\SDK\MediaManagement\ViewModel\MediaDocument' => $this->serializeObjectCCTSDKMediaManagementViewModelMediaDocument($object),
                'CCT\SDK\MediaManagement\ViewModel\MediaImage' => $this->serializeObjectCCTSDKMediaManagementViewModelMediaImage($object),
                'CCT\SDK\MediaManagement\ViewModel\MediaVideo' => $this->serializeObjectCCTSDKMediaManagementViewModelMediaVideo($object),
                'CCT\SDK\MediaManagement\ViewModel\SearchResult' => $this->serializeObjectCCTSDKMediaManagementViewModelSearchResult($object),
                default => throw new \LogicException('No serialization defined for $className'),
            };
        } catch (\Throwable $exception) {
            throw UnableToSerializeObject::dueToError($className, $exception);
        }
    }
    
    
    private function serializeValuearray(mixed $value): mixed
    {
        static $serializer;
        
        if ($serializer === null) {
            $serializer = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        return $serializer->serialize($value, $this);
    }


    private function serializeValueRamseyUuidUuidInterface(mixed $value): mixed
    {
        static $serializer;
        
        if ($serializer === null) {
            $serializer = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeUuidToString(...array (
));
        }
        
        return $serializer->serialize($value, $this);
    }


    private function serializeValueDateTime(mixed $value): mixed
    {
        static $serializer;
        
        if ($serializer === null) {
            $serializer = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeDateTime(...array (
));
        }
        
        return $serializer->serialize($value, $this);
    }


    private function serializeValueDateTimeImmutable(mixed $value): mixed
    {
        static $serializer;
        
        if ($serializer === null) {
            $serializer = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeDateTime(...array (
));
        }
        
        return $serializer->serialize($value, $this);
    }


    private function serializeValueDateTimeInterface(mixed $value): mixed
    {
        static $serializer;
        
        if ($serializer === null) {
            $serializer = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeDateTime(...array (
));
        }
        
        return $serializer->serialize($value, $this);
    }

    
    private function serializeObjectCCTSDKAnalyticsResponseAnalytics(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Analytics\Response\Analytics);
        $result = [];
        
        $clicks = $object->clicks;
        $clicks = $this->serializeObjectCCTSDKAnalyticsResponseAnalyticsClicks($clicks);
        after_clicks:        $result['clicks'] = $clicks;

        
        $facebook = $object->facebook;
        $facebook = $this->serializeObjectCCTSDKAnalyticsResponseAnalyticsFacebook($facebook);
        after_facebook:        $result['facebook'] = $facebook;

        
        $impressions = $object->impressions;
        $impressions = $this->serializeObjectCCTSDKAnalyticsResponseAnalyticsImpressions($impressions);
        after_impressions:        $result['impressions'] = $impressions;

        
        $reach = $object->reach;
        $reach = $this->serializeObjectCCTSDKAnalyticsResponseAnalyticsReach($reach);
        after_reach:        $result['reach'] = $reach;

        
        $readers = $object->readers;
        $readers = $this->serializeObjectCCTSDKAnalyticsResponseAnalyticsReaders($readers);
        after_readers:        $result['readers'] = $readers;

        
        $target = $object->target;
        $target = $this->serializeObjectCCTSDKAnalyticsResponseAnalyticsTarget($target);
        after_target:        $result['target'] = $target;


        return $result;
    }

    
    private function serializeObjectCCTSDKAnalyticsResponseAnalyticsClicks(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Analytics\Response\Analytics\Clicks);
        $result = [];
        
        $clicks = $object->clicks;
        after_clicks:        $result['clicks'] = $clicks;

        
        $clicksPerDay = $object->clicksPerDay;
        static $clicksPerDaySerializer0;

        if ($clicksPerDaySerializer0 === null) {
            $clicksPerDaySerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $clicksPerDay = $clicksPerDaySerializer0->serialize($clicksPerDay, $this);
        after_clicksPerDay:        $result['clicks_per_day'] = $clicksPerDay;

        
        $clicksPerChannel = $object->clicksPerChannel;
        static $clicksPerChannelSerializer0;

        if ($clicksPerChannelSerializer0 === null) {
            $clicksPerChannelSerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $clicksPerChannel = $clicksPerChannelSerializer0->serialize($clicksPerChannel, $this);
        after_clicksPerChannel:        $result['clicks_per_channel'] = $clicksPerChannel;


        return $result;
    }

    
    private function serializeObjectCCTSDKAnalyticsResponseAnalyticsFacebook(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Analytics\Response\Analytics\Facebook);
        $result = [];
        
        $likesShares = $object->likesShares;
        after_likesShares:        $result['likes_shares'] = $likesShares;

        
        $fbLikes = $object->fbLikes;
        after_fbLikes:        $result['fb_likes'] = $fbLikes;

        
        $fbShares = $object->fbShares;
        after_fbShares:        $result['fb_shares'] = $fbShares;

        
        $fbComments = $object->fbComments;
        after_fbComments:        $result['fb_comments'] = $fbComments;

        
        $fbGenderAgeRange = $object->fbGenderAgeRange;
        static $fbGenderAgeRangeSerializer0;

        if ($fbGenderAgeRangeSerializer0 === null) {
            $fbGenderAgeRangeSerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $fbGenderAgeRange = $fbGenderAgeRangeSerializer0->serialize($fbGenderAgeRange, $this);
        after_fbGenderAgeRange:        $result['fb_gender_age_range'] = $fbGenderAgeRange;


        return $result;
    }

    
    private function serializeObjectCCTSDKAnalyticsResponseAnalyticsImpressions(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Analytics\Response\Analytics\Impressions);
        $result = [];
        
        $impressions = $object->impressions;
        after_impressions:        $result['impressions'] = $impressions;

        
        $impressionsCtr = $object->impressionsCtr;
        after_impressionsCtr:        $result['impressions_ctr'] = $impressionsCtr;

        
        $impressionsByChannel = $object->impressionsByChannel;
        static $impressionsByChannelSerializer0;

        if ($impressionsByChannelSerializer0 === null) {
            $impressionsByChannelSerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $impressionsByChannel = $impressionsByChannelSerializer0->serialize($impressionsByChannel, $this);
        after_impressionsByChannel:        $result['impressions_by_channel'] = $impressionsByChannel;

        
        $impressionsPerDay = $object->impressionsPerDay;
        static $impressionsPerDaySerializer0;

        if ($impressionsPerDaySerializer0 === null) {
            $impressionsPerDaySerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $impressionsPerDay = $impressionsPerDaySerializer0->serialize($impressionsPerDay, $this);
        after_impressionsPerDay:        $result['impressions_per_day'] = $impressionsPerDay;


        return $result;
    }

    
    private function serializeObjectCCTSDKAnalyticsResponseAnalyticsReach(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Analytics\Response\Analytics\Reach);
        $result = [];
        
        $reach = $object->reach;
        after_reach:        $result['reach'] = $reach;

        
        $reachCtr = $object->reachCtr;
        after_reachCtr:        $result['reach_ctr'] = $reachCtr;


        return $result;
    }

    
    private function serializeObjectCCTSDKAnalyticsResponseAnalyticsReaders(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Analytics\Response\Analytics\Readers);
        $result = [];
        
        $readers = $object->readers;
        after_readers:        $result['readers'] = $readers;

        
        $cctReaders = $object->cctReaders;
        after_cctReaders:        $result['cct_readers'] = $cctReaders;

        
        $otherReaders = $object->otherReaders;
        after_otherReaders:        $result['other_readers'] = $otherReaders;

        
        $totalReaders = $object->totalReaders;
        after_totalReaders:        $result['total_readers'] = $totalReaders;


        return $result;
    }

    
    private function serializeObjectCCTSDKAnalyticsResponseAnalyticsTarget(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Analytics\Response\Analytics\Target);
        $result = [];
        
        $targetGroupSize = $object->targetGroupSize;
        after_targetGroupSize:        $result['target_group_size'] = $targetGroupSize;

        
        $averageTime = $object->averageTime;
        after_averageTime:        $result['average_time'] = $averageTime;


        return $result;
    }

    
    private function serializeObjectCCTSDKAnalyticsResponseCampaignAnalytics(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Analytics\Response\CampaignAnalytics);
        $result = [];
        
        $campaignId = $object->campaignId;
        static $campaignIdSerializer0;

        if ($campaignIdSerializer0 === null) {
            $campaignIdSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\CampaignId',
));
        }
        
        $campaignId = $campaignIdSerializer0->serialize($campaignId, $this);
        after_campaignId:        $result['campaign_id'] = $campaignId;

        
        $orderCode = $object->orderCode;
        after_orderCode:        $result['order_code'] = $orderCode;

        
        $orderType = $object->orderType;
        after_orderType:        $result['order_type'] = $orderType;

        
        $customer = $object->customer;
        $customer = $this->serializeObjectCCTSDKAnalyticsResponseCustomer($customer);
        after_customer:        $result['customer'] = $customer;

        
        $analytics = $object->analytics;
        $analytics = $this->serializeObjectCCTSDKAnalyticsResponseAnalytics($analytics);
        after_analytics:        $result['analytics'] = $analytics;

        
        $period = $object->period;
        $period = $this->serializeObjectCCTSDKAnalyticsResponsePeriod($period);
        after_period:        $result['period'] = $period;


        return $result;
    }

    
    private function serializeObjectCCTSDKAnalyticsResponseCustomer(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Analytics\Response\Customer);
        $result = [];
        
        $id = $object->id;
        static $idSerializer0;

        if ($idSerializer0 === null) {
            $idSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Customer\\Data\\CustomerId',
));
        }
        
        $id = $idSerializer0->serialize($id, $this);
        after_id:        $result['id'] = $id;

        
        $agencyId = $object->agencyId;
        static $agencyIdSerializer0;

        if ($agencyIdSerializer0 === null) {
            $agencyIdSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Customer\\Data\\AgencyId',
));
        }
        
        $agencyId = $agencyIdSerializer0->serialize($agencyId, $this);
        after_agencyId:        $result['agency_id'] = $agencyId;


        return $result;
    }

    
    private function serializeObjectCCTSDKAnalyticsResponsePeriod(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Analytics\Response\Period);
        $result = [];
        
        $startDate = $object->startDate;
        static $startDateSerializer0;

        if ($startDateSerializer0 === null) {
            $startDateSerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeDateTime(...array (
));
        }
        
        $startDate = $startDateSerializer0->serialize($startDate, $this);
        after_startDate:        $result['start_date'] = $startDate;

        
        $endDate = $object->endDate;
        static $endDateSerializer0;

        if ($endDateSerializer0 === null) {
            $endDateSerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeDateTime(...array (
));
        }
        
        $endDate = $endDateSerializer0->serialize($endDate, $this);
        after_endDate:        $result['end_date'] = $endDate;

        
        $createdAt = $object->createdAt;
        static $createdAtSerializer0;

        if ($createdAtSerializer0 === null) {
            $createdAtSerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeDateTime(...array (
));
        }
        
        $createdAt = $createdAtSerializer0->serialize($createdAt, $this);
        after_createdAt:        $result['created_at'] = $createdAt;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignFlowDataCampaignFlowId(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\CampaignFlow\Data\CampaignFlowId);
        $result = [];
        
        $toString = $object->toString();
        after_toString:        $result['to_string'] = $toString;

        
        $toNative = $object->toNative();
        after_toNative:        $result['to_native'] = $toNative;

        
        $__toString = $object->__toString();
        after___toString:        $result['__to_string'] = $__toString;

        
        $value = $object->value;
        static $valueSerializer0;

        if ($valueSerializer0 === null) {
            $valueSerializer0 = new \EventSauce\ObjectHydrator\PropertyCasters\CastToUuid(...array (
));
        }
        
        $value = $valueSerializer0->serialize($value, $this);
        after_value:        $result['value'] = $value;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignFlowDataCurrency(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\CampaignFlow\Data\Currency);
        $result = [];
        
        $toString = $object->toString();
        after_toString:        $result['to_string'] = $toString;

        
        $__toString = $object->__toString();
        after___toString:        $result['__to_string'] = $__toString;

        
        $toNative = $object->toNative();
        after_toNative:        $result['to_native'] = $toNative;

        
        $value = $object->value;
        after_value:        $result['value'] = $value;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignFlowDataExcludeVat(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\CampaignFlow\Data\ExcludeVat);
        $result = [];
        
        $toArray = $object->toArray();
        static $toArraySerializer0;

        if ($toArraySerializer0 === null) {
            $toArraySerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $toArray = $toArraySerializer0->serialize($toArray, $this);
        after_toArray:        $result['to_array'] = $toArray;

        
        $isEnabled = $object->isEnabled();
        after_isEnabled:        $result['is_enabled'] = $isEnabled;

        
        $__toString = $object->__toString();
        after___toString:        $result['__to_string'] = $__toString;

        
        $toString = $object->toString();
        after_toString:        $result['to_string'] = $toString;

        
        $enabled = $object->enabled;
        static $enabledSerializer0;

        if ($enabledSerializer0 === null) {
            $enabledSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Infrastructure\\ValueObject\\Enabled',
));
        }
        
        $enabled = $enabledSerializer0->serialize($enabled, $this);
        after_enabled:        $result['enabled'] = $enabled;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignFlowDataPricing(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\CampaignFlow\Data\Pricing);
        $result = [];
        
        $items = $object->items();
        static $itemsSerializer0;

        if ($itemsSerializer0 === null) {
            $itemsSerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $items = $itemsSerializer0->serialize($items, $this);
        after_items:        $result['items'] = $items;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignFlowDataPricingItem(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\CampaignFlow\Data\PricingItem);
        $result = [];
        
        $toArray = $object->toArray();
        static $toArraySerializer0;

        if ($toArraySerializer0 === null) {
            $toArraySerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $toArray = $toArraySerializer0->serialize($toArray, $this);
        after_toArray:        $result['to_array'] = $toArray;

        
        $__toString = $object->__toString();
        after___toString:        $result['__to_string'] = $__toString;

        
        $toString = $object->toString();
        after_toString:        $result['to_string'] = $toString;

        
        $type = $object->type;
        $type = $type->value;        after_type:        $result['type'] = $type;

        
        $price = $object->price;
        after_price:        $result['price'] = $price;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignFlowDataSettings(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\CampaignFlow\Data\Settings);
        $result = [];
        
        $toArray = $object->toArray();
        static $toArraySerializer0;

        if ($toArraySerializer0 === null) {
            $toArraySerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $toArray = $toArraySerializer0->serialize($toArray, $this);
        after_toArray:        $result['to_array'] = $toArray;

        
        $__toString = $object->__toString();
        after___toString:        $result['__to_string'] = $__toString;

        
        $toString = $object->toString();
        after_toString:        $result['to_string'] = $toString;

        
        $currency = $object->currency;
        static $currencySerializer0;

        if ($currencySerializer0 === null) {
            $currencySerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\CampaignFlow\\Data\\Currency',
));
        }
        
        $currency = $currencySerializer0->serialize($currency, $this);
        after_currency:        $result['currency'] = $currency;

        
        $vat = $object->vat;
        static $vatSerializer0;

        if ($vatSerializer0 === null) {
            $vatSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\CampaignFlow\\Data\\Vat',
));
        }
        
        $vat = $vatSerializer0->serialize($vat, $this);
        after_vat:        $result['vat'] = $vat;

        
        $excludeVat = $object->excludeVat;
        $excludeVat = $this->serializeObjectCCTSDKCampaignFlowDataExcludeVat($excludeVat);
        after_excludeVat:        $result['exclude_vat'] = $excludeVat;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignFlowDataVat(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\CampaignFlow\Data\Vat);
        $result = [];
        
        $toFloat = $object->toFloat();
        after_toFloat:        $result['to_float'] = $toFloat;

        
        $__toString = $object->__toString();
        after___toString:        $result['__to_string'] = $__toString;

        
        $toString = $object->toString();
        after_toString:        $result['to_string'] = $toString;

        
        $toNative = $object->toNative();
        after_toNative:        $result['to_native'] = $toNative;

        
        $value = $object->value;
        after_value:        $result['value'] = $value;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignFlowResponseCampaignFlowItem(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\CampaignFlow\Response\CampaignFlowItem);
        $result = [];
        
        $toArray = $object->toArray();
        static $toArraySerializer0;

        if ($toArraySerializer0 === null) {
            $toArraySerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $toArray = $toArraySerializer0->serialize($toArray, $this);
        after_toArray:        $result['to_array'] = $toArray;

        
        $__toString = $object->__toString();
        after___toString:        $result['__to_string'] = $__toString;

        
        $toString = $object->toString();
        after_toString:        $result['to_string'] = $toString;

        
        $id = $object->id;
        static $idSerializer0;

        if ($idSerializer0 === null) {
            $idSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\CampaignFlow\\Data\\CampaignFlowId',
));
        }
        
        $id = $idSerializer0->serialize($id, $this);
        after_id:        $result['id'] = $id;

        
        $name = $object->name;
        after_name:        $result['name'] = $name;

        
        $label = $object->label;
        after_label:        $result['label'] = $label;

        
        $pricing = $object->pricing;
        static $pricingSerializer0;

        if ($pricingSerializer0 === null) {
            $pricingSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\CampaignFlow\\Data\\Pricing',
));
        }
        
        $pricing = $pricingSerializer0->serialize($pricing, $this);
        after_pricing:        $result['pricing'] = $pricing;

        
        $category = $object->category;
        $category = $category->value;        after_category:        $result['category'] = $category;

        
        $settings = $object->settings;
        $settings = $this->serializeObjectCCTSDKCampaignFlowDataSettings($settings);
        after_settings:        $result['settings'] = $settings;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignFlowResponseListResponse(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\CampaignFlow\Response\ListResponse);
        $result = [];
        
        $items = $object->items();
        static $itemsSerializer0;

        if ($itemsSerializer0 === null) {
            $itemsSerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $items = $itemsSerializer0->serialize($items, $this);
        after_items:        $result['items'] = $items;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentAdContent(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\AdContent);
        $result = [];
        
        $campaignImages = $object->campaignImages;

        if ($campaignImages === null) {
            goto after_campaignImages;
        }
        $campaignImages = $this->serializeObjectCCTSDKCampaignDataAdContentCampaignImageCampaignImages($campaignImages);
        after_campaignImages:        $result['campaign_images'] = $campaignImages;

        
        $campaignVideos = $object->campaignVideos;

        if ($campaignVideos === null) {
            goto after_campaignVideos;
        }
        $campaignVideos = $this->serializeObjectCCTSDKCampaignDataAdContentCampaignVideoCampaignVideos($campaignVideos);
        after_campaignVideos:        $result['campaign_videos'] = $campaignVideos;

        
        $facebookAiMultiAdVariants = $object->facebookAiMultiAdVariants;

        if ($facebookAiMultiAdVariants === null) {
            goto after_facebookAiMultiAdVariants;
        }
        static $facebookAiMultiAdVariantsSerializer0;

        if ($facebookAiMultiAdVariantsSerializer0 === null) {
            $facebookAiMultiAdVariantsSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\AdVariant\\Facebook\\FacebookAiMultiAdVariants',
));
        }
        
        $facebookAiMultiAdVariants = $facebookAiMultiAdVariantsSerializer0->serialize($facebookAiMultiAdVariants, $this);
        after_facebookAiMultiAdVariants:        $result['facebook_ai_multi_ad_variants'] = $facebookAiMultiAdVariants;

        
        $facebookCarouselVariants = $object->facebookCarouselVariants;

        if ($facebookCarouselVariants === null) {
            goto after_facebookCarouselVariants;
        }
        static $facebookCarouselVariantsSerializer0;

        if ($facebookCarouselVariantsSerializer0 === null) {
            $facebookCarouselVariantsSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\AdVariant\\FacebookCarousel\\FacebookCarouselVariants',
));
        }
        
        $facebookCarouselVariants = $facebookCarouselVariantsSerializer0->serialize($facebookCarouselVariants, $this);
        after_facebookCarouselVariants:        $result['facebook_carousel_variants'] = $facebookCarouselVariants;

        
        $adText = $object->adText;

        if ($adText === null) {
            goto after_adText;
        }
        $adText = $this->serializeObjectCCTSDKCampaignDataAdContentAdText($adText);
        after_adText:        $result['ad_text'] = $adText;

        
        $linkedInAdVariants = $object->linkedInAdVariants;

        if ($linkedInAdVariants === null) {
            goto after_linkedInAdVariants;
        }
        static $linkedInAdVariantsSerializer0;

        if ($linkedInAdVariantsSerializer0 === null) {
            $linkedInAdVariantsSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\AdVariant\\LinkedIn\\LinkedInAdVariants',
));
        }
        
        $linkedInAdVariants = $linkedInAdVariantsSerializer0->serialize($linkedInAdVariants, $this);
        after_linkedInAdVariants:        $result['linked_in_ad_variants'] = $linkedInAdVariants;

        
        $twitterAdVariants = $object->twitterAdVariants;

        if ($twitterAdVariants === null) {
            goto after_twitterAdVariants;
        }
        static $twitterAdVariantsSerializer0;

        if ($twitterAdVariantsSerializer0 === null) {
            $twitterAdVariantsSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\AdVariant\\Twitter\\TwitterAdVariants',
));
        }
        
        $twitterAdVariants = $twitterAdVariantsSerializer0->serialize($twitterAdVariants, $this);
        after_twitterAdVariants:        $result['twitter_ad_variants'] = $twitterAdVariants;

        
        $googleResponsiveAdVariants = $object->googleResponsiveAdVariants;

        if ($googleResponsiveAdVariants === null) {
            goto after_googleResponsiveAdVariants;
        }
        static $googleResponsiveAdVariantsSerializer0;

        if ($googleResponsiveAdVariantsSerializer0 === null) {
            $googleResponsiveAdVariantsSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\AdVariant\\Google\\GoogleResponsiveAdVariants',
));
        }
        
        $googleResponsiveAdVariants = $googleResponsiveAdVariantsSerializer0->serialize($googleResponsiveAdVariants, $this);
        after_googleResponsiveAdVariants:        $result['google_responsive_ad_variants'] = $googleResponsiveAdVariants;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentAdText(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\AdText);
        $result = [];
        
        $enabled = $object->enabled;
        static $enabledSerializer0;

        if ($enabledSerializer0 === null) {
            $enabledSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Infrastructure\\ValueObject\\Enabled',
));
        }
        
        $enabled = $enabledSerializer0->serialize($enabled, $this);
        after_enabled:        $result['enabled'] = $enabled;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentAdVariantFacebookCarouselFacebookCarouselCard(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel\FacebookCarouselCard);
        $result = [];
        
        $heading = $object->heading;
        after_heading:        $result['heading'] = $heading;

        
        $description = $object->description;
        after_description:        $result['description'] = $description;

        
        $image = $object->image;

        if ($image === null) {
            goto after_image;
        }
        $image = $this->serializeObjectCCTSDKCampaignDataAdContentImageImage($image);
        after_image:        $result['image'] = $image;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentAdVariantFacebookCarouselFacebookCarouselCardCollection(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel\FacebookCarouselCardCollection);
        $result = [];
        
        $items = $object->items();
        static $itemsSerializer0;

        if ($itemsSerializer0 === null) {
            $itemsSerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $items = $itemsSerializer0->serialize($items, $this);
        after_items:        $result['items'] = $items;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentAdVariantFacebookCarouselFacebookCarouselVariant(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel\FacebookCarouselVariant);
        $result = [];
        
        $text = $object->text;
        after_text:        $result['text'] = $text;

        
        $cardCollection = $object->cardCollection;
        $cardCollection = $this->serializeObjectCCTSDKCampaignDataAdContentAdVariantFacebookCarouselFacebookCarouselCardCollection($cardCollection);
        after_cardCollection:        $result['card_collection'] = $cardCollection;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentAdVariantFacebookCarouselFacebookCarouselVariants(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel\FacebookCarouselVariants);
        $result = [];
        
        $items = $object->items();
        static $itemsSerializer0;

        if ($itemsSerializer0 === null) {
            $itemsSerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $items = $itemsSerializer0->serialize($items, $this);
        after_items:        $result['items'] = $items;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentAdVariantFacebookAiMultiVariantPartDescription(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\Description);
        $result = [];
        
        $value = $object->value;
        after_value:        $result['value'] = $value;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentAdVariantFacebookAiMultiVariantPartDescriptionCollection(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\DescriptionCollection);
        $result = [];
        
        $items = $object->items();
        static $itemsSerializer0;

        if ($itemsSerializer0 === null) {
            $itemsSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastListToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\AdVariant\\Facebook\\AiMultiVariantPart\\DescriptionCollection',
));
        }
        
        $items = $itemsSerializer0->serialize($items, $this);
        after_items:        $result['items'] = $items;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentAdVariantFacebookAiMultiVariantPartHeading(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\Heading);
        $result = [];
        
        $value = $object->value;
        after_value:        $result['value'] = $value;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentAdVariantFacebookAiMultiVariantPartHeadingCollection(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\HeadingCollection);
        $result = [];
        
        $items = $object->items();
        static $itemsSerializer0;

        if ($itemsSerializer0 === null) {
            $itemsSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastListToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\AdVariant\\Facebook\\AiMultiVariantPart\\HeadingCollection',
));
        }
        
        $items = $itemsSerializer0->serialize($items, $this);
        after_items:        $result['items'] = $items;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentAdVariantFacebookAiMultiVariantPartText(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\Text);
        $result = [];
        
        $value = $object->value;
        after_value:        $result['value'] = $value;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentAdVariantFacebookAiMultiVariantPartTextCollection(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\TextCollection);
        $result = [];
        
        $items = $object->items();
        static $itemsSerializer0;

        if ($itemsSerializer0 === null) {
            $itemsSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastListToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\AdVariant\\Facebook\\AiMultiVariantPart\\TextCollection',
));
        }
        
        $items = $itemsSerializer0->serialize($items, $this);
        after_items:        $result['items'] = $items;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentAdVariantFacebookFacebookAiMultiAdVariant(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\FacebookAiMultiAdVariant);
        $result = [];
        
        $texts = $object->texts;
        static $textsSerializer0;

        if ($textsSerializer0 === null) {
            $textsSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\AdVariant\\Facebook\\AiMultiVariantPart\\TextCollection',
));
        }
        
        $texts = $textsSerializer0->serialize($texts, $this);
        after_texts:        $result['texts'] = $texts;

        
        $headings = $object->headings;
        static $headingsSerializer0;

        if ($headingsSerializer0 === null) {
            $headingsSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\AdVariant\\Facebook\\AiMultiVariantPart\\HeadingCollection',
));
        }
        
        $headings = $headingsSerializer0->serialize($headings, $this);
        after_headings:        $result['headings'] = $headings;

        
        $descriptions = $object->descriptions;
        static $descriptionsSerializer0;

        if ($descriptionsSerializer0 === null) {
            $descriptionsSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\AdVariant\\Facebook\\AiMultiVariantPart\\DescriptionCollection',
));
        }
        
        $descriptions = $descriptionsSerializer0->serialize($descriptions, $this);
        after_descriptions:        $result['descriptions'] = $descriptions;

        
        $images = $object->images;

        if ($images === null) {
            goto after_images;
        }
        static $imagesSerializer0;

        if ($imagesSerializer0 === null) {
            $imagesSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\Image\\ImageCollection',
));
        }
        
        $images = $imagesSerializer0->serialize($images, $this);
        after_images:        $result['images'] = $images;

        
        $videos = $object->videos;

        if ($videos === null) {
            goto after_videos;
        }
        static $videosSerializer0;

        if ($videosSerializer0 === null) {
            $videosSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\Video\\VideoCollection',
));
        }
        
        $videos = $videosSerializer0->serialize($videos, $this);
        after_videos:        $result['videos'] = $videos;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentAdVariantFacebookFacebookAiMultiAdVariants(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\FacebookAiMultiAdVariants);
        $result = [];
        
        $items = $object->items();
        static $itemsSerializer0;

        if ($itemsSerializer0 === null) {
            $itemsSerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $items = $itemsSerializer0->serialize($items, $this);
        after_items:        $result['items'] = $items;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentAdVariantGoogleGoogleAdVariant(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleAdVariant);
        $result = [];
        
        $textLine1 = $object->textLine1;
        after_textLine1:        $result['text_line1'] = $textLine1;

        
        $textLine2 = $object->textLine2;
        after_textLine2:        $result['text_line2'] = $textLine2;

        
        $imageCollection = $object->imageCollection;

        if ($imageCollection === null) {
            goto after_imageCollection;
        }
        $imageCollection = $this->serializeObjectCCTSDKCampaignDataAdContentImageImageCollection($imageCollection);
        after_imageCollection:        $result['image_collection'] = $imageCollection;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentAdVariantGoogleGoogleAdVariants(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleAdVariants);
        $result = [];
        
        $items = $object->items();
        static $itemsSerializer0;

        if ($itemsSerializer0 === null) {
            $itemsSerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $items = $itemsSerializer0->serialize($items, $this);
        after_items:        $result['items'] = $items;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentAdVariantGoogleGoogleResponsiveAdVariant(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleResponsiveAdVariant);
        $result = [];
        
        $shortHeadlines = $object->shortHeadlines;
        static $shortHeadlinesSerializer0;

        if ($shortHeadlinesSerializer0 === null) {
            $shortHeadlinesSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\AdVariant\\Google\\ResponsiveAd\\ShortHeadlineCollection',
));
        }
        
        $shortHeadlines = $shortHeadlinesSerializer0->serialize($shortHeadlines, $this);
        after_shortHeadlines:        $result['short_headlines'] = $shortHeadlines;

        
        $longHeadline = $object->longHeadline;
        static $longHeadlineSerializer0;

        if ($longHeadlineSerializer0 === null) {
            $longHeadlineSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\AdVariant\\Google\\ResponsiveAd\\LongHeadline',
));
        }
        
        $longHeadline = $longHeadlineSerializer0->serialize($longHeadline, $this);
        after_longHeadline:        $result['long_headline'] = $longHeadline;

        
        $descriptions = $object->descriptions;
        static $descriptionsSerializer0;

        if ($descriptionsSerializer0 === null) {
            $descriptionsSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\AdVariant\\Google\\ResponsiveAd\\DescriptionCollection',
));
        }
        
        $descriptions = $descriptionsSerializer0->serialize($descriptions, $this);
        after_descriptions:        $result['descriptions'] = $descriptions;

        
        $images = $object->images;

        if ($images === null) {
            goto after_images;
        }
        static $imagesSerializer0;

        if ($imagesSerializer0 === null) {
            $imagesSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\Image\\ImageCollection',
));
        }
        
        $images = $imagesSerializer0->serialize($images, $this);
        after_images:        $result['images'] = $images;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentAdVariantGoogleGoogleResponsiveAdVariants(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleResponsiveAdVariants);
        $result = [];
        
        $items = $object->items();
        static $itemsSerializer0;

        if ($itemsSerializer0 === null) {
            $itemsSerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $items = $itemsSerializer0->serialize($items, $this);
        after_items:        $result['items'] = $items;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentAdVariantGoogleResponsiveAdDescription(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\Description);
        $result = [];
        
        $value = $object->value;
        after_value:        $result['value'] = $value;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentAdVariantGoogleResponsiveAdDescriptionCollection(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\DescriptionCollection);
        $result = [];
        
        $items = $object->items();
        static $itemsSerializer0;

        if ($itemsSerializer0 === null) {
            $itemsSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastListToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\AdVariant\\Google\\ResponsiveAd\\DescriptionCollection',
));
        }
        
        $items = $itemsSerializer0->serialize($items, $this);
        after_items:        $result['items'] = $items;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentAdVariantGoogleResponsiveAdLongHeadline(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\LongHeadline);
        $result = [];
        
        $value = $object->value;
        after_value:        $result['value'] = $value;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentAdVariantGoogleResponsiveAdShortHeadline(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\ShortHeadline);
        $result = [];
        
        $value = $object->value;
        after_value:        $result['value'] = $value;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentAdVariantGoogleResponsiveAdShortHeadlineCollection(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\ShortHeadlineCollection);
        $result = [];
        
        $items = $object->items();
        static $itemsSerializer0;

        if ($itemsSerializer0 === null) {
            $itemsSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastListToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\AdVariant\\Google\\ResponsiveAd\\ShortHeadlineCollection',
));
        }
        
        $items = $itemsSerializer0->serialize($items, $this);
        after_items:        $result['items'] = $items;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentAdVariantLinkedInLinkedInAdVariant(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\AdVariant\LinkedIn\LinkedInAdVariant);
        $result = [];
        
        $text = $object->text;
        after_text:        $result['text'] = $text;

        
        $images = $object->images;

        if ($images === null) {
            goto after_images;
        }
        static $imagesSerializer0;

        if ($imagesSerializer0 === null) {
            $imagesSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\Image\\ImageCollection',
));
        }
        
        $images = $imagesSerializer0->serialize($images, $this);
        after_images:        $result['images'] = $images;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentAdVariantLinkedInLinkedInAdVariants(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\AdVariant\LinkedIn\LinkedInAdVariants);
        $result = [];
        
        $items = $object->items();
        static $itemsSerializer0;

        if ($itemsSerializer0 === null) {
            $itemsSerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $items = $itemsSerializer0->serialize($items, $this);
        after_items:        $result['items'] = $items;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentAdVariantTwitterTwitterAdVariant(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\AdVariant\Twitter\TwitterAdVariant);
        $result = [];
        
        $text = $object->text;
        after_text:        $result['text'] = $text;

        
        $imageCollection = $object->imageCollection;

        if ($imageCollection === null) {
            goto after_imageCollection;
        }
        $imageCollection = $this->serializeObjectCCTSDKCampaignDataAdContentImageImageCollection($imageCollection);
        after_imageCollection:        $result['image_collection'] = $imageCollection;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentAdVariantTwitterTwitterAdVariants(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\AdVariant\Twitter\TwitterAdVariants);
        $result = [];
        
        $items = $object->items();
        static $itemsSerializer0;

        if ($itemsSerializer0 === null) {
            $itemsSerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $items = $itemsSerializer0->serialize($items, $this);
        after_items:        $result['items'] = $items;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentCampaignImageCampaignImages(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\CampaignImage\CampaignImages);
        $result = [];
        
        $channelImages = $object->channelImages;

        if ($channelImages === null) {
            goto after_channelImages;
        }
        static $channelImagesSerializer0;

        if ($channelImagesSerializer0 === null) {
            $channelImagesSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\CampaignImage\\ChannelImage\\ChannelCollection',
));
        }
        
        $channelImages = $channelImagesSerializer0->serialize($channelImages, $this);
        after_channelImages:        $result['channel_images'] = $channelImages;

        
        $userImagesSelected = $object->userImagesSelected;
        after_userImagesSelected:        $result['user_images_selected'] = $userImagesSelected;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentCampaignImageChannelImageAbstractChannelImages(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\AbstractChannelImages);
        $result = [];
        
        $images = $object->images;
        static $imagesSerializer0;

        if ($imagesSerializer0 === null) {
            $imagesSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\Image\\ImageCollection',
));
        }
        
        $images = $imagesSerializer0->serialize($images, $this);
        after_images:        $result['images'] = $images;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentCampaignImageChannelImageChannelCollection(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\ChannelCollection);
        $result = [];
        
        $items = $object->items();
        static $itemsSerializer0;

        if ($itemsSerializer0 === null) {
            $itemsSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastListUnionToType(...array (
  0 => 
  array (
    'facebook_images' => 'CCT\\SDK\\Campaign\\Data\\AdContent\\CampaignImage\\ChannelImage\\FacebookImages',
    'google_images' => 'CCT\\SDK\\Campaign\\Data\\AdContent\\CampaignImage\\ChannelImage\\GoogleImages',
    'general_images' => 'CCT\\SDK\\Campaign\\Data\\AdContent\\CampaignImage\\ChannelImage\\GeneralImages',
  ),
));
        }
        
        $items = $itemsSerializer0->serialize($items, $this);
        after_items:        $result['items'] = $items;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentCampaignImageChannelImageFacebookImages(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\FacebookImages);
        $result = [];
        
        $images = $object->images;
        static $imagesSerializer0;

        if ($imagesSerializer0 === null) {
            $imagesSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\Image\\ImageCollection',
));
        }
        
        $images = $imagesSerializer0->serialize($images, $this);
        after_images:        $result['images'] = $images;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentCampaignImageChannelImageGeneralImages(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\GeneralImages);
        $result = [];
        
        $images = $object->images;
        static $imagesSerializer0;

        if ($imagesSerializer0 === null) {
            $imagesSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\Image\\ImageCollection',
));
        }
        
        $images = $imagesSerializer0->serialize($images, $this);
        after_images:        $result['images'] = $images;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentCampaignImageChannelImageGoogleImages(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\CampaignImage\ChannelImage\GoogleImages);
        $result = [];
        
        $images = $object->images;
        static $imagesSerializer0;

        if ($imagesSerializer0 === null) {
            $imagesSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\Image\\ImageCollection',
));
        }
        
        $images = $imagesSerializer0->serialize($images, $this);
        after_images:        $result['images'] = $images;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentCampaignVideoCampaignVideos(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\CampaignVideo\CampaignVideos);
        $result = [];
        
        $videos = $object->videos;
        static $videosSerializer0;

        if ($videosSerializer0 === null) {
            $videosSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\Video\\VideoCollection',
));
        }
        
        $videos = $videosSerializer0->serialize($videos, $this);
        after_videos:        $result['videos'] = $videos;

        
        $userSelected = $object->userSelected;
        after_userSelected:        $result['user_selected'] = $userSelected;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentImageImage(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\Image\Image);
        $result = [];
        
        $imageUrl = $object->imageUrl;
        static $imageUrlSerializer0;

        if ($imageUrlSerializer0 === null) {
            $imageUrlSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Infrastructure\\ValueObject\\Uri',
));
        }
        
        $imageUrl = $imageUrlSerializer0->serialize($imageUrl, $this);
        after_imageUrl:        $result['image_url'] = $imageUrl;

        
        $uuid = $object->uuid;
        static $uuidSerializer0;

        if ($uuidSerializer0 === null) {
            $uuidSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\AdContent\\Image\\ImageId',
));
        }
        
        $uuid = $uuidSerializer0->serialize($uuid, $this);
        after_uuid:        $result['uuid'] = $uuid;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentImageImageCollection(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\Image\ImageCollection);
        $result = [];
        
        $items = $object->items();
        static $itemsSerializer0;

        if ($itemsSerializer0 === null) {
            $itemsSerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $items = $itemsSerializer0->serialize($items, $this);
        after_items:        $result['items'] = $items;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentImageImageId(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\Image\ImageId);
        $result = [];
        
        $value = $object->value;
        static $valueSerializer0;

        if ($valueSerializer0 === null) {
            $valueSerializer0 = new \EventSauce\ObjectHydrator\PropertyCasters\CastToUuid(...array (
));
        }
        
        $value = $valueSerializer0->serialize($value, $this);
        after_value:        $result['value'] = $value;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentUserSelected(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\UserSelected);
        $result = [];
        
        $value = $object->value;
        after_value:        $result['value'] = $value;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentVideoVideo(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\Video\Video);
        $result = [];
        
        $videoUrl = $object->videoUrl;
        $videoUrl = $this->serializeObjectCCTSDKInfrastructureValueObjectUri($videoUrl);
        after_videoUrl:        $result['video_url'] = $videoUrl;

        
        $uuid = $object->uuid;
        $uuid = $this->serializeObjectCCTSDKCampaignDataAdContentVideoVideoId($uuid);
        after_uuid:        $result['uuid'] = $uuid;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentVideoVideoCollection(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\Video\VideoCollection);
        $result = [];
        

        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataAdContentVideoVideoId(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\AdContent\Video\VideoId);
        $result = [];
        
        $value = $object->value;
        static $valueSerializer0;

        if ($valueSerializer0 === null) {
            $valueSerializer0 = new \EventSauce\ObjectHydrator\PropertyCasters\CastToUuid(...array (
));
        }
        
        $value = $valueSerializer0->serialize($value, $this);
        after_value:        $result['value'] = $value;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataCampaignId(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\CampaignId);
        $result = [];
        
        $value = $object->value;
        static $valueSerializer0;

        if ($valueSerializer0 === null) {
            $valueSerializer0 = new \EventSauce\ObjectHydrator\PropertyCasters\CastToUuid(...array (
));
        }
        
        $value = $valueSerializer0->serialize($value, $this);
        after_value:        $result['value'] = $value;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataDetailsCampaignPeriod(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\Details\CampaignPeriod);
        $result = [];
        
        $startDate = $object->startDate;
        static $startDateSerializer0;

        if ($startDateSerializer0 === null) {
            $startDateSerializer0 = new \EventSauce\ObjectHydrator\PropertyCasters\CastToDateTimeImmutable(...array (
  0 => 'Y-m-d',
));
        }
        
        $startDate = $startDateSerializer0->serialize($startDate, $this);
        after_startDate:        $result['start_date'] = $startDate;

        
        $endDate = $object->endDate;
        static $endDateSerializer0;

        if ($endDateSerializer0 === null) {
            $endDateSerializer0 = new \EventSauce\ObjectHydrator\PropertyCasters\CastToDateTimeImmutable(...array (
  0 => 'Y-m-d',
));
        }
        
        $endDate = $endDateSerializer0->serialize($endDate, $this);
        after_endDate:        $result['end_date'] = $endDate;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataDetailsCampaignTitle(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\Details\CampaignTitle);
        $result = [];
        
        $value = $object->value;
        after_value:        $result['value'] = $value;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataDetailsDetails(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\Details\Details);
        $result = [];
        
        $campaignTitle = $object->campaignTitle;
        static $campaignTitleSerializer0;

        if ($campaignTitleSerializer0 === null) {
            $campaignTitleSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\Details\\CampaignTitle',
));
        }
        
        $campaignTitle = $campaignTitleSerializer0->serialize($campaignTitle, $this);
        after_campaignTitle:        $result['campaign_title'] = $campaignTitle;

        
        $campaignPeriod = $object->campaignPeriod;
        $campaignPeriod = $this->serializeObjectCCTSDKCampaignDataDetailsCampaignPeriod($campaignPeriod);
        after_campaignPeriod:        $result['campaign_period'] = $campaignPeriod;

        
        $landingPage = $object->landingPage;
        static $landingPageSerializer0;

        if ($landingPageSerializer0 === null) {
            $landingPageSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\Details\\LandingPage',
));
        }
        
        $landingPage = $landingPageSerializer0->serialize($landingPage, $this);
        after_landingPage:        $result['landing_page'] = $landingPage;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataDetailsLandingPage(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\Details\LandingPage);
        $result = [];
        
        $value = $object->value;
        after_value:        $result['value'] = $value;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataOptionsAdvancedSlideshow(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\Options\AdvancedSlideshow);
        $result = [];
        
        $enabled = $object->enabled;
        static $enabledSerializer0;

        if ($enabledSerializer0 === null) {
            $enabledSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Infrastructure\\ValueObject\\Enabled',
));
        }
        
        $enabled = $enabledSerializer0->serialize($enabled, $this);
        after_enabled:        $result['enabled'] = $enabled;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataOptionsAfterSoldAction(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\Options\AfterSoldAction);
        $result = [];
        
        $actionType = $object->actionType;
        $actionType = $actionType->value;        after_actionType:        $result['action_type'] = $actionType;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataOptionsFacebookSlideshow(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\Options\FacebookSlideshow);
        $result = [];
        
        $enabled = $object->enabled;
        static $enabledSerializer0;

        if ($enabledSerializer0 === null) {
            $enabledSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Infrastructure\\ValueObject\\Enabled',
));
        }
        
        $enabled = $enabledSerializer0->serialize($enabled, $this);
        after_enabled:        $result['enabled'] = $enabled;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataOptionsLocalBoost(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\Options\LocalBoost);
        $result = [];
        
        $enabled = $object->enabled;
        static $enabledSerializer0;

        if ($enabledSerializer0 === null) {
            $enabledSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Infrastructure\\ValueObject\\Enabled',
));
        }
        
        $enabled = $enabledSerializer0->serialize($enabled, $this);
        after_enabled:        $result['enabled'] = $enabled;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataOptionsNewPrice(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\Options\NewPrice);
        $result = [];
        
        $enabled = $object->enabled;
        static $enabledSerializer0;

        if ($enabledSerializer0 === null) {
            $enabledSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Infrastructure\\ValueObject\\Enabled',
));
        }
        
        $enabled = $enabledSerializer0->serialize($enabled, $this);
        after_enabled:        $result['enabled'] = $enabled;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataOptionsOptions(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\Options\Options);
        $result = [];
        
        $advancedSlideshow = $object->advancedSlideshow;

        if ($advancedSlideshow === null) {
            goto after_advancedSlideshow;
        }
        $advancedSlideshow = $this->serializeObjectCCTSDKCampaignDataOptionsAdvancedSlideshow($advancedSlideshow);
        after_advancedSlideshow:        $result['advanced_slideshow'] = $advancedSlideshow;

        
        $facebookSlideshow = $object->facebookSlideshow;

        if ($facebookSlideshow === null) {
            goto after_facebookSlideshow;
        }
        $facebookSlideshow = $this->serializeObjectCCTSDKCampaignDataOptionsFacebookSlideshow($facebookSlideshow);
        after_facebookSlideshow:        $result['facebook_slideshow'] = $facebookSlideshow;

        
        $localBoost = $object->localBoost;

        if ($localBoost === null) {
            goto after_localBoost;
        }
        $localBoost = $this->serializeObjectCCTSDKCampaignDataOptionsLocalBoost($localBoost);
        after_localBoost:        $result['local_boost'] = $localBoost;

        
        $postFirstVariantToFacebook = $object->postFirstVariantToFacebook;

        if ($postFirstVariantToFacebook === null) {
            goto after_postFirstVariantToFacebook;
        }
        $postFirstVariantToFacebook = $this->serializeObjectCCTSDKCampaignDataOptionsPostFirstVariantToFacebook($postFirstVariantToFacebook);
        after_postFirstVariantToFacebook:        $result['post_first_variant_to_facebook'] = $postFirstVariantToFacebook;

        
        $afterSoldAction = $object->afterSoldAction;

        if ($afterSoldAction === null) {
            goto after_afterSoldAction;
        }
        $afterSoldAction = $this->serializeObjectCCTSDKCampaignDataOptionsAfterSoldAction($afterSoldAction);
        after_afterSoldAction:        $result['after_sold_action'] = $afterSoldAction;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataOptionsPostFirstVariantToFacebook(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\Options\PostFirstVariantToFacebook);
        $result = [];
        
        $enabled = $object->enabled;
        static $enabledSerializer0;

        if ($enabledSerializer0 === null) {
            $enabledSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Infrastructure\\ValueObject\\Enabled',
));
        }
        
        $enabled = $enabledSerializer0->serialize($enabled, $this);
        after_enabled:        $result['enabled'] = $enabled;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataTargetingLocationTargetingAddress(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Address);
        $result = [];
        
        $streetNumber = $object->streetNumber;

        if ($streetNumber === null) {
            goto after_streetNumber;
        }
        after_streetNumber:        $result['street_number'] = $streetNumber;

        
        $streetName = $object->streetName;

        if ($streetName === null) {
            goto after_streetName;
        }
        after_streetName:        $result['street_name'] = $streetName;

        
        $neighborhood = $object->neighborhood;

        if ($neighborhood === null) {
            goto after_neighborhood;
        }
        after_neighborhood:        $result['neighborhood'] = $neighborhood;

        
        $locality = $object->locality;

        if ($locality === null) {
            goto after_locality;
        }
        after_locality:        $result['locality'] = $locality;

        
        $region = $object->region;

        if ($region === null) {
            goto after_region;
        }
        after_region:        $result['region'] = $region;

        
        $postalCode = $object->postalCode;

        if ($postalCode === null) {
            goto after_postalCode;
        }
        after_postalCode:        $result['postal_code'] = $postalCode;

        
        $country = $object->country;

        if ($country === null) {
            goto after_country;
        }
        $country = $this->serializeObjectCCTSDKCampaignDataTargetingLocationTargetingCountry($country);
        after_country:        $result['country'] = $country;

        
        $formattedAddress = $object->formattedAddress;

        if ($formattedAddress === null) {
            goto after_formattedAddress;
        }
        after_formattedAddress:        $result['formatted_address'] = $formattedAddress;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataTargetingLocationTargetingCoordinate(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Coordinate);
        $result = [];
        
        $latitude = $object->latitude;
        after_latitude:        $result['latitude'] = $latitude;

        
        $longitude = $object->longitude;
        after_longitude:        $result['longitude'] = $longitude;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataTargetingLocationTargetingCountry(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Country);
        $result = [];
        
        $name = $object->name;
        after_name:        $result['name'] = $name;

        
        $code = $object->code;
        after_code:        $result['code'] = $code;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataTargetingLocationTargetingIndustryAddress(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\Targeting\LocationTargeting\IndustryAddress);
        $result = [];
        
        $address = $object->address;
        $address = $this->serializeObjectCCTSDKCampaignDataTargetingLocationTargetingAddress($address);
        after_address:        $result['address'] = $address;

        
        $coordinate = $object->coordinate;

        if ($coordinate === null) {
            goto after_coordinate;
        }
        $coordinate = $this->serializeObjectCCTSDKCampaignDataTargetingLocationTargetingCoordinate($coordinate);
        after_coordinate:        $result['coordinate'] = $coordinate;

        
        $type = $object->type;

        if ($type === null) {
            goto after_type;
        }
        $type = $type->value;        after_type:        $result['type'] = $type;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataTargetingLocationTargetingLocation(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Location);
        $result = [];
        
        $address = $object->address;
        after_address:        $result['address'] = $address;

        
        $coordinate = $object->coordinate;
        $coordinate = $this->serializeObjectCCTSDKCampaignDataTargetingLocationTargetingCoordinate($coordinate);
        after_coordinate:        $result['coordinate'] = $coordinate;

        
        $radius = $object->radius;
        $radius = $this->serializeObjectCCTSDKCampaignDataTargetingLocationTargetingRadius($radius);
        after_radius:        $result['radius'] = $radius;

        
        $type = $object->type;

        if ($type === null) {
            goto after_type;
        }
        $type = $type->value;        after_type:        $result['type'] = $type;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataTargetingLocationTargetingLocations(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Locations);
        $result = [];
        
        $items = $object->items();
        static $itemsSerializer0;

        if ($itemsSerializer0 === null) {
            $itemsSerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $items = $itemsSerializer0->serialize($items, $this);
        after_items:        $result['items'] = $items;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataTargetingLocationTargetingRadius(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Radius);
        $result = [];
        
        $radius = $object->radius;
        after_radius:        $result['radius'] = $radius;

        
        $measurementUnit = $object->measurementUnit;
        $measurementUnit = $measurementUnit->value;        after_measurementUnit:        $result['measurement_unit'] = $measurementUnit;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataTargetingPropertyInformationNumberOfBedrooms(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\Targeting\PropertyInformation\NumberOfBedrooms);
        $result = [];
        
        $value = $object->value;
        after_value:        $result['value'] = $value;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataTargetingPropertyInformationPropertyInformation(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertyInformation);
        $result = [];
        
        $propertyPrice = $object->propertyPrice;

        if ($propertyPrice === null) {
            goto after_propertyPrice;
        }
        static $propertyPriceSerializer0;

        if ($propertyPriceSerializer0 === null) {
            $propertyPriceSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\Targeting\\PropertyInformation\\PropertyPrice',
));
        }
        
        $propertyPrice = $propertyPriceSerializer0->serialize($propertyPrice, $this);
        after_propertyPrice:        $result['property_price'] = $propertyPrice;

        
        $propertySize = $object->propertySize;

        if ($propertySize === null) {
            goto after_propertySize;
        }
        static $propertySizeSerializer0;

        if ($propertySizeSerializer0 === null) {
            $propertySizeSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\Targeting\\PropertyInformation\\PropertySize',
));
        }
        
        $propertySize = $propertySizeSerializer0->serialize($propertySize, $this);
        after_propertySize:        $result['property_size'] = $propertySize;

        
        $numberOfBedrooms = $object->numberOfBedrooms;

        if ($numberOfBedrooms === null) {
            goto after_numberOfBedrooms;
        }
        static $numberOfBedroomsSerializer0;

        if ($numberOfBedroomsSerializer0 === null) {
            $numberOfBedroomsSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\Targeting\\PropertyInformation\\NumberOfBedrooms',
));
        }
        
        $numberOfBedrooms = $numberOfBedroomsSerializer0->serialize($numberOfBedrooms, $this);
        after_numberOfBedrooms:        $result['number_of_bedrooms'] = $numberOfBedrooms;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataTargetingPropertyInformationPropertyPrice(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertyPrice);
        $result = [];
        
        $value = $object->value;
        after_value:        $result['value'] = $value;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataTargetingPropertyInformationPropertySize(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertySize);
        $result = [];
        
        $value = $object->value;
        after_value:        $result['value'] = $value;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignDataTargetingTargeting(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Data\Targeting\Targeting);
        $result = [];
        
        $locations = $object->locations;
        static $locationsSerializer0;

        if ($locationsSerializer0 === null) {
            $locationsSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\Targeting\\LocationTargeting\\Locations',
));
        }
        
        $locations = $locationsSerializer0->serialize($locations, $this);
        after_locations:        $result['locations'] = $locations;

        
        $industryAddress = $object->industryAddress;
        $industryAddress = $this->serializeObjectCCTSDKCampaignDataTargetingLocationTargetingIndustryAddress($industryAddress);
        after_industryAddress:        $result['industry_address'] = $industryAddress;

        
        $propertyInformation = $object->propertyInformation;
        $propertyInformation = $this->serializeObjectCCTSDKCampaignDataTargetingPropertyInformationPropertyInformation($propertyInformation);
        after_propertyInformation:        $result['property_information'] = $propertyInformation;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignPayloadCreateCampaign(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Payload\CreateCampaign);
        $result = [];
        
        $campaignFlowId = $object->campaignFlowId;
        static $campaignFlowIdSerializer0;

        if ($campaignFlowIdSerializer0 === null) {
            $campaignFlowIdSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\CampaignFlow\\Data\\CampaignFlowId',
));
        }
        
        $campaignFlowId = $campaignFlowIdSerializer0->serialize($campaignFlowId, $this);
        after_campaignFlowId:        $result['campaign_flow_uuid'] = $campaignFlowId;

        
        $details = $object->details;
        $details = $this->serializeObjectCCTSDKCampaignDataDetailsDetails($details);
        after_details:        $result['details'] = $details;

        
        $adContent = $object->adContent;
        $adContent = $this->serializeObjectCCTSDKCampaignDataAdContentAdContent($adContent);
        after_adContent:        $result['ad_content'] = $adContent;

        
        $targeting = $object->targeting;
        $targeting = $this->serializeObjectCCTSDKCampaignDataTargetingTargeting($targeting);
        after_targeting:        $result['targeting'] = $targeting;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignPayloadSaveCampaign(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Payload\SaveCampaign);
        $result = [];
        
        $details = $object->details;

        if ($details === null) {
            goto after_details;
        }
        $details = $this->serializeObjectCCTSDKCampaignDataDetailsDetails($details);
        after_details:        $result['details'] = $details;

        
        $adContent = $object->adContent;

        if ($adContent === null) {
            goto after_adContent;
        }
        $adContent = $this->serializeObjectCCTSDKCampaignDataAdContentAdContent($adContent);
        after_adContent:        $result['ad_content'] = $adContent;

        
        $targeting = $object->targeting;

        if ($targeting === null) {
            goto after_targeting;
        }
        $targeting = $this->serializeObjectCCTSDKCampaignDataTargetingTargeting($targeting);
        after_targeting:        $result['targeting'] = $targeting;

        
        $options = $object->options;

        if ($options === null) {
            goto after_options;
        }
        $options = $this->serializeObjectCCTSDKCampaignDataOptionsOptions($options);
        after_options:        $result['options'] = $options;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignPayloadStartCampaign(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Payload\StartCampaign);
        $result = [];
        
        $campaignFlowUuid = $object->campaignFlowUuid;
        static $campaignFlowUuidSerializer0;

        if ($campaignFlowUuidSerializer0 === null) {
            $campaignFlowUuidSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\CampaignFlow\\Data\\CampaignFlowId',
));
        }
        
        $campaignFlowUuid = $campaignFlowUuidSerializer0->serialize($campaignFlowUuid, $this);
        after_campaignFlowUuid:        $result['campaign_flow_uuid'] = $campaignFlowUuid;


        return $result;
    }

    
    private function serializeObjectCCTSDKCampaignResponseCommonMutateResponse(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Campaign\Response\CommonMutateResponse);
        $result = [];
        
        $toArray = $object->toArray();
        static $toArraySerializer0;

        if ($toArraySerializer0 === null) {
            $toArraySerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $toArray = $toArraySerializer0->serialize($toArray, $this);
        after_toArray:        $result['to_array'] = $toArray;

        
        $__toString = $object->__toString();
        after___toString:        $result['__to_string'] = $__toString;

        
        $toString = $object->toString();
        after_toString:        $result['to_string'] = $toString;

        
        $campaignId = $object->campaignId;
        static $campaignIdSerializer0;

        if ($campaignIdSerializer0 === null) {
            $campaignIdSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Campaign\\Data\\CampaignId',
));
        }
        
        $campaignId = $campaignIdSerializer0->serialize($campaignId, $this);
        after_campaignId:        $result['uuid'] = $campaignId;


        return $result;
    }

    
    private function serializeObjectCCTSDKCustomerDataAgencyId(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Customer\Data\AgencyId);
        $result = [];
        
        $toString = $object->toString();
        after_toString:        $result['to_string'] = $toString;

        
        $toNative = $object->toNative();
        after_toNative:        $result['to_native'] = $toNative;

        
        $__toString = $object->__toString();
        after___toString:        $result['__to_string'] = $__toString;

        
        $value = $object->value;
        static $valueSerializer0;

        if ($valueSerializer0 === null) {
            $valueSerializer0 = new \EventSauce\ObjectHydrator\PropertyCasters\CastToUuid(...array (
));
        }
        
        $value = $valueSerializer0->serialize($value, $this);
        after_value:        $result['value'] = $value;


        return $result;
    }

    
    private function serializeObjectCCTSDKCustomerDataCustomerId(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Customer\Data\CustomerId);
        $result = [];
        
        $toString = $object->toString();
        after_toString:        $result['to_string'] = $toString;

        
        $toNative = $object->toNative();
        after_toNative:        $result['to_native'] = $toNative;

        
        $__toString = $object->__toString();
        after___toString:        $result['__to_string'] = $__toString;

        
        $value = $object->value;
        static $valueSerializer0;

        if ($valueSerializer0 === null) {
            $valueSerializer0 = new \EventSauce\ObjectHydrator\PropertyCasters\CastToUuid(...array (
));
        }
        
        $value = $valueSerializer0->serialize($value, $this);
        after_value:        $result['value'] = $value;


        return $result;
    }

    
    private function serializeObjectCCTSDKCustomerDataName(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Customer\Data\Name);
        $result = [];
        
        $toString = $object->toString();
        after_toString:        $result['to_string'] = $toString;

        
        $__toString = $object->__toString();
        after___toString:        $result['__to_string'] = $__toString;

        
        $toNative = $object->toNative();
        after_toNative:        $result['to_native'] = $toNative;

        
        $value = $object->value;
        after_value:        $result['value'] = $value;


        return $result;
    }

    
    private function serializeObjectCCTSDKCustomerResponseListResult(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Customer\Response\ListResult);
        $result = [];
        
        $items = $object->items();
        static $itemsSerializer0;

        if ($itemsSerializer0 === null) {
            $itemsSerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $items = $itemsSerializer0->serialize($items, $this);
        after_items:        $result['items'] = $items;


        return $result;
    }

    
    private function serializeObjectCCTSDKCustomerResponseListAgency(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Customer\Response\List\Agency);
        $result = [];
        
        $toArray = $object->toArray();
        static $toArraySerializer0;

        if ($toArraySerializer0 === null) {
            $toArraySerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $toArray = $toArraySerializer0->serialize($toArray, $this);
        after_toArray:        $result['to_array'] = $toArray;

        
        $__toString = $object->__toString();
        after___toString:        $result['__to_string'] = $__toString;

        
        $toString = $object->toString();
        after_toString:        $result['to_string'] = $toString;

        
        $id = $object->id;
        static $idSerializer0;

        if ($idSerializer0 === null) {
            $idSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Customer\\Data\\AgencyId',
));
        }
        
        $id = $idSerializer0->serialize($id, $this);
        after_id:        $result['id'] = $id;

        
        $name = $object->name;
        static $nameSerializer0;

        if ($nameSerializer0 === null) {
            $nameSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Customer\\Data\\Name',
));
        }
        
        $name = $nameSerializer0->serialize($name, $this);
        after_name:        $result['name'] = $name;

        
        $tradingName = $object->tradingName;

        if ($tradingName === null) {
            goto after_tradingName;
        }
        static $tradingNameSerializer0;

        if ($tradingNameSerializer0 === null) {
            $tradingNameSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Customer\\Data\\Name',
));
        }
        
        $tradingName = $tradingNameSerializer0->serialize($tradingName, $this);
        after_tradingName:        $result['trading_name'] = $tradingName;

        
        $customers = $object->customers;
        static $customersSerializer0;

        if ($customersSerializer0 === null) {
            $customersSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\Customer\\Response\\List\\Customers',
));
        }
        
        $customers = $customersSerializer0->serialize($customers, $this);
        after_customers:        $result['customers'] = $customers;


        return $result;
    }

    
    private function serializeObjectCCTSDKCustomerResponseListCustomer(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Customer\Response\List\Customer);
        $result = [];
        
        $toArray = $object->toArray();
        static $toArraySerializer0;

        if ($toArraySerializer0 === null) {
            $toArraySerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $toArray = $toArraySerializer0->serialize($toArray, $this);
        after_toArray:        $result['to_array'] = $toArray;

        
        $__toString = $object->__toString();
        after___toString:        $result['__to_string'] = $__toString;

        
        $toString = $object->toString();
        after_toString:        $result['to_string'] = $toString;

        
        $id = $object->id;
        static $idSerializer0;

        if ($idSerializer0 === null) {
            $idSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Customer\\Data\\CustomerId',
));
        }
        
        $id = $idSerializer0->serialize($id, $this);
        after_id:        $result['id'] = $id;

        
        $name = $object->name;
        static $nameSerializer0;

        if ($nameSerializer0 === null) {
            $nameSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Customer\\Data\\Name',
));
        }
        
        $name = $nameSerializer0->serialize($name, $this);
        after_name:        $result['name'] = $name;

        
        $tradingName = $object->tradingName;

        if ($tradingName === null) {
            goto after_tradingName;
        }
        static $tradingNameSerializer0;

        if ($tradingNameSerializer0 === null) {
            $tradingNameSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToSingleValueObject(...array (
  0 => 'CCT\\SDK\\Customer\\Data\\Name',
));
        }
        
        $tradingName = $tradingNameSerializer0->serialize($tradingName, $this);
        after_tradingName:        $result['trading_name'] = $tradingName;


        return $result;
    }

    
    private function serializeObjectCCTSDKCustomerResponseListCustomers(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\Customer\Response\List\Customers);
        $result = [];
        
        $items = $object->items();
        static $itemsSerializer0;

        if ($itemsSerializer0 === null) {
            $itemsSerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $items = $itemsSerializer0->serialize($items, $this);
        after_items:        $result['items'] = $items;


        return $result;
    }

    
    private function serializeObjectCCTSDKMediaManagementRequestContextContext(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\MediaManagement\Request\Context\Context);
        $result = [];
        
        $toArray = $object->toArray();
        static $toArraySerializer0;

        if ($toArraySerializer0 === null) {
            $toArraySerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $toArray = $toArraySerializer0->serialize($toArray, $this);
        after_toArray:        $result['to_array'] = $toArray;

        
        $__toString = $object->__toString();
        after___toString:        $result['__to_string'] = $__toString;

        
        $name = $object->name();
        after_name:        $result['name'] = $name;


        return $result;
    }

    
    private function serializeObjectCCTSDKMediaManagementRequestMediaBaseMediaCreate(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\MediaManagement\Request\Media\BaseMediaCreate);
        $result = [];
        
        $id = $object->id;

        if ($id === null) {
            goto after_id;
        }
        after_id:        $result['id'] = $id;

        
        $name = $object->name;

        if ($name === null) {
            goto after_name;
        }
        after_name:        $result['name'] = $name;

        
        $description = $object->description;

        if ($description === null) {
            goto after_description;
        }
        after_description:        $result['description'] = $description;

        
        $private = $object->private;

        if ($private === null) {
            goto after_private;
        }
        after_private:        $result['private'] = $private;

        
        $type = $object->type;

        if ($type === null) {
            goto after_type;
        }
        $type = $type->value;        after_type:        $result['type'] = $type;

        
        $predefinedName = $object->predefinedName;

        if ($predefinedName === null) {
            goto after_predefinedName;
        }
        after_predefinedName:        $result['predefined_name'] = $predefinedName;


        return $result;
    }

    
    private function serializeObjectCCTSDKMediaManagementRequestMediaCreateMediaCollection(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\MediaManagement\Request\Media\CreateMediaCollection);
        $result = [];
        
        $items = $object->items();
        static $itemsSerializer0;

        if ($itemsSerializer0 === null) {
            $itemsSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastListUnionToType(...array (
  0 => 
  array (
    'remote_file' => 'CCT\\SDK\\MediaManagement\\Request\\Media\\RemoteMedia',
    'external_url' => 'CCT\\SDK\\MediaManagement\\Request\\Media\\ExternalMedia',
    'file_resource' => 'CCT\\SDK\\MediaManagement\\Request\\Media\\UploadMedia',
  ),
));
        }
        
        $items = $itemsSerializer0->serialize($items, $this);
        after_items:        $result['items'] = $items;


        return $result;
    }

    
    private function serializeObjectCCTSDKMediaManagementRequestMediaExternalMedia(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\MediaManagement\Request\Media\ExternalMedia);
        $result = [];
        
        $baseMediaCreate = $object->baseMediaCreate;
        $baseMediaCreate = $this->serializeObjectCCTSDKMediaManagementRequestMediaBaseMediaCreate($baseMediaCreate);
        after_baseMediaCreate:        $result['id'] = $baseMediaCreate['id'];        $result['name'] = $baseMediaCreate['name'];        $result['description'] = $baseMediaCreate['description'];        $result['private'] = $baseMediaCreate['private'];        $result['type'] = $baseMediaCreate['type'];        $result['predefined_name'] = $baseMediaCreate['predefined_name'];
        
        $externalUrl = $object->externalUrl;
        after_externalUrl:        $result['external_url'] = $externalUrl;


        return $result;
    }

    
    private function serializeObjectCCTSDKMediaManagementRequestMediaMediaId(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\MediaManagement\Request\Media\MediaId);
        $result = [];
        
        $toString = $object->toString();
        after_toString:        $result['to_string'] = $toString;

        
        $toNative = $object->toNative();
        after_toNative:        $result['to_native'] = $toNative;

        
        $__toString = $object->__toString();
        after___toString:        $result['__to_string'] = $__toString;

        
        $value = $object->value;
        static $valueSerializer0;

        if ($valueSerializer0 === null) {
            $valueSerializer0 = new \EventSauce\ObjectHydrator\PropertyCasters\CastToUuid(...array (
));
        }
        
        $value = $valueSerializer0->serialize($value, $this);
        after_value:        $result['value'] = $value;


        return $result;
    }

    
    private function serializeObjectCCTSDKMediaManagementRequestMediaMediaIdCollection(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\MediaManagement\Request\Media\MediaIdCollection);
        $result = [];
        
        $items = $object->items();
        static $itemsSerializer0;

        if ($itemsSerializer0 === null) {
            $itemsSerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $items = $itemsSerializer0->serialize($items, $this);
        after_items:        $result['items'] = $items;


        return $result;
    }

    
    private function serializeObjectCCTSDKMediaManagementRequestMediaMediaTypeCollection(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\MediaManagement\Request\Media\MediaTypeCollection);
        $result = [];
        
        $items = $object->items();
        static $itemsSerializer0;

        if ($itemsSerializer0 === null) {
            $itemsSerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $items = $itemsSerializer0->serialize($items, $this);
        after_items:        $result['items'] = $items;


        return $result;
    }

    
    private function serializeObjectCCTSDKMediaManagementRequestMediaRemoteMedia(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\MediaManagement\Request\Media\RemoteMedia);
        $result = [];
        
        $baseMediaCreate = $object->baseMediaCreate;
        $baseMediaCreate = $this->serializeObjectCCTSDKMediaManagementRequestMediaBaseMediaCreate($baseMediaCreate);
        after_baseMediaCreate:        $result['id'] = $baseMediaCreate['id'];        $result['name'] = $baseMediaCreate['name'];        $result['description'] = $baseMediaCreate['description'];        $result['private'] = $baseMediaCreate['private'];        $result['type'] = $baseMediaCreate['type'];        $result['predefined_name'] = $baseMediaCreate['predefined_name'];
        
        $remoteFile = $object->remoteFile;
        after_remoteFile:        $result['remote_file'] = $remoteFile;


        return $result;
    }

    
    private function serializeObjectCCTSDKMediaManagementRequestMediaStatusCollection(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\MediaManagement\Request\Media\StatusCollection);
        $result = [];
        
        $items = $object->items();
        static $itemsSerializer0;

        if ($itemsSerializer0 === null) {
            $itemsSerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $items = $itemsSerializer0->serialize($items, $this);
        after_items:        $result['items'] = $items;


        return $result;
    }

    
    private function serializeObjectCCTSDKMediaManagementRequestMediaUploadMedia(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\MediaManagement\Request\Media\UploadMedia);
        $result = [];
        
        $toMultipart = $object->toMultipart();
        static $toMultipartSerializer0;

        if ($toMultipartSerializer0 === null) {
            $toMultipartSerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $toMultipart = $toMultipartSerializer0->serialize($toMultipart, $this);
        after_toMultipart:        $result['to_multipart'] = $toMultipart;

        
        $toArray = $object->toArray();
        static $toArraySerializer0;

        if ($toArraySerializer0 === null) {
            $toArraySerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $toArray = $toArraySerializer0->serialize($toArray, $this);
        after_toArray:        $result['to_array'] = $toArray;

        
        $__toString = $object->__toString();
        after___toString:        $result['__to_string'] = $__toString;

        
        $toString = $object->toString();
        after_toString:        $result['to_string'] = $toString;

        
        $baseMediaCreate = $object->baseMediaCreate;
        $baseMediaCreate = $this->serializeObjectCCTSDKMediaManagementRequestMediaBaseMediaCreate($baseMediaCreate);
        after_baseMediaCreate:        $result['id'] = $baseMediaCreate['id'];        $result['name'] = $baseMediaCreate['name'];        $result['description'] = $baseMediaCreate['description'];        $result['private'] = $baseMediaCreate['private'];        $result['type'] = $baseMediaCreate['type'];        $result['predefined_name'] = $baseMediaCreate['predefined_name'];
        
        $fileResource = $object->fileResource;

        if ($fileResource === null) {
            goto after_fileResource;
        }
        after_fileResource:        $result['file_resource'] = $fileResource;

        
        $fileName = $object->fileName;
        after_fileName:        $result['file_name'] = $fileName;


        return $result;
    }

    
    private function serializeObjectCCTSDKMediaManagementRequestSearchQueryParams(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\MediaManagement\Request\SearchQueryParams);
        $result = [];
        
        $toArray = $object->toArray();
        static $toArraySerializer0;

        if ($toArraySerializer0 === null) {
            $toArraySerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $toArray = $toArraySerializer0->serialize($toArray, $this);
        after_toArray:        $result['to_array'] = $toArray;

        
        $toQueryParams = $object->toQueryParams();
        static $toQueryParamsSerializer0;

        if ($toQueryParamsSerializer0 === null) {
            $toQueryParamsSerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $toQueryParams = $toQueryParamsSerializer0->serialize($toQueryParams, $this);
        after_toQueryParams:        $result['to_query_params'] = $toQueryParams;

        
        $limit = $object->limit;
        after_limit:        $result['limit'] = $limit;

        
        $page = $object->page;
        after_page:        $result['page'] = $page;

        
        $q = $object->q;

        if ($q === null) {
            goto after_q;
        }
        after_q:        $result['q'] = $q;

        
        $types = $object->types;

        if ($types === null) {
            goto after_types;
        }
        $types = $this->serializeObjectCCTSDKMediaManagementRequestMediaMediaTypeCollection($types);
        after_types:        $result['types'] = $types;

        
        $id = $object->id;

        if ($id === null) {
            goto after_id;
        }
        after_id:        $result['id'] = $id;

        
        $sort = $object->sort;

        if ($sort === null) {
            goto after_sort;
        }
        after_sort:        $result['sort'] = $sort;

        
        $direction = $object->direction;

        if ($direction === null) {
            goto after_direction;
        }
        after_direction:        $result['direction'] = $direction;

        
        $statuses = $object->statuses;

        if ($statuses === null) {
            goto after_statuses;
        }
        $statuses = $this->serializeObjectCCTSDKMediaManagementRequestMediaStatusCollection($statuses);
        after_statuses:        $result['statuses'] = $statuses;

        
        $context = $object->context;

        if ($context === null) {
            goto after_context;
        }
        $context = $this->serializeObjectCCTSDKMediaManagementRequestContextContext($context);
        after_context:        $result['context'] = $context;


        return $result;
    }

    
    private function serializeObjectCCTSDKMediaManagementViewModelBaseMedia(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\MediaManagement\ViewModel\BaseMedia);
        $result = [];
        
        $id = $object->id;
        after_id:        $result['id'] = $id;

        
        $name = $object->name;
        after_name:        $result['name'] = $name;

        
        $description = $object->description;

        if ($description === null) {
            goto after_description;
        }
        after_description:        $result['description'] = $description;

        
        $private = $object->private;
        after_private:        $result['private'] = $private;

        
        $extension = $object->extension;

        if ($extension === null) {
            goto after_extension;
        }
        after_extension:        $result['extension'] = $extension;

        
        $status = $object->status;
        $status = $status->value;        after_status:        $result['status'] = $status;

        
        $external = $object->external;
        after_external:        $result['external'] = $external;

        
        $contexts = $object->contexts;

        if ($contexts === null) {
            goto after_contexts;
        }
        static $contextsSerializer0;

        if ($contextsSerializer0 === null) {
            $contextsSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\MediaManagement\\ViewModel\\ContextCollection',
));
        }
        
        $contexts = $contextsSerializer0->serialize($contexts, $this);
        after_contexts:        $result['contexts'] = $contexts;

        
        $type = $object->type;
        $type = $type->value;        after_type:        $result['type'] = $type;

        
        $endpoint = $object->endpoint;

        if ($endpoint === null) {
            goto after_endpoint;
        }
        after_endpoint:        $result['endpoint'] = $endpoint;

        
        $fileFormat = $object->fileFormat;

        if ($fileFormat === null) {
            goto after_fileFormat;
        }
        after_fileFormat:        $result['file_format'] = $fileFormat;

        
        $originalUri = $object->originalUri;

        if ($originalUri === null) {
            goto after_originalUri;
        }
        after_originalUri:        $result['original_uri'] = $originalUri;


        return $result;
    }

    
    private function serializeObjectCCTSDKMediaManagementViewModelContext(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\MediaManagement\ViewModel\Context);
        $result = [];
        
        $id = $object->id;

        if ($id === null) {
            goto after_id;
        }
        after_id:        $result['id'] = $id;

        
        $name = $object->name;
        after_name:        $result['name'] = $name;


        return $result;
    }

    
    private function serializeObjectCCTSDKMediaManagementViewModelContextCollection(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\MediaManagement\ViewModel\ContextCollection);
        $result = [];
        
        $items = $object->items();
        static $itemsSerializer0;

        if ($itemsSerializer0 === null) {
            $itemsSerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $items = $itemsSerializer0->serialize($items, $this);
        after_items:        $result['items'] = $items;


        return $result;
    }

    
    private function serializeObjectCCTSDKMediaManagementViewModelMediaAudio(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\MediaManagement\ViewModel\MediaAudio);
        $result = [];
        
        $baseMedia = $object->baseMedia;
        $baseMedia = $this->serializeObjectCCTSDKMediaManagementViewModelBaseMedia($baseMedia);
        after_baseMedia:        $result['id'] = $baseMedia['id'];        $result['name'] = $baseMedia['name'];        $result['description'] = $baseMedia['description'];        $result['private'] = $baseMedia['private'];        $result['extension'] = $baseMedia['extension'];        $result['status'] = $baseMedia['status'];        $result['external'] = $baseMedia['external'];        $result['contexts'] = $baseMedia['contexts'];        $result['type'] = $baseMedia['type'];        $result['endpoint'] = $baseMedia['endpoint'];        $result['file_format'] = $baseMedia['file_format'];        $result['original_uri'] = $baseMedia['original_uri'];
        
        $contentSize = $object->contentSize;

        if ($contentSize === null) {
            goto after_contentSize;
        }
        after_contentSize:        $result['content_size'] = $contentSize;

        
        $duration = $object->duration;

        if ($duration === null) {
            goto after_duration;
        }
        after_duration:        $result['duration'] = $duration;


        return $result;
    }

    
    private function serializeObjectCCTSDKMediaManagementViewModelMediaCollection(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\MediaManagement\ViewModel\MediaCollection);
        $result = [];
        
        $items = $object->items();
        static $itemsSerializer0;

        if ($itemsSerializer0 === null) {
            $itemsSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastListUnionToType(...array (
  0 => 
  array (
    'image' => 'CCT\\SDK\\MediaManagement\\ViewModel\\MediaImage',
    'video' => 'CCT\\SDK\\MediaManagement\\ViewModel\\MediaVideo',
    'document' => 'CCT\\SDK\\MediaManagement\\ViewModel\\MediaDocument',
    'audio' => 'CCT\\SDK\\MediaManagement\\ViewModel\\MediaAudio',
  ),
));
        }
        
        $items = $itemsSerializer0->serialize($items, $this);
        after_items:        $result['items'] = $items;


        return $result;
    }

    
    private function serializeObjectCCTSDKMediaManagementViewModelMediaDocument(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\MediaManagement\ViewModel\MediaDocument);
        $result = [];
        
        $toArray = $object->toArray();
        static $toArraySerializer0;

        if ($toArraySerializer0 === null) {
            $toArraySerializer0 = new \EventSauce\ObjectHydrator\PropertySerializers\SerializeArrayItems(...array (
));
        }
        
        $toArray = $toArraySerializer0->serialize($toArray, $this);
        after_toArray:        $result['to_array'] = $toArray;

        
        $__toString = $object->__toString();
        after___toString:        $result['__to_string'] = $__toString;

        
        $toString = $object->toString();
        after_toString:        $result['to_string'] = $toString;

        
        $id = $object->id();
        after_id:        $result['id'] = $id;

        
        $name = $object->name();

        if ($name === null) {
            goto after_name;
        }
        after_name:        $result['name'] = $name;

        
        $description = $object->description();

        if ($description === null) {
            goto after_description;
        }
        after_description:        $result['description'] = $description;

        
        $private = $object->private();
        after_private:        $result['private'] = $private;

        
        $extension = $object->extension();

        if ($extension === null) {
            goto after_extension;
        }
        after_extension:        $result['extension'] = $extension;

        
        $status = $object->status();

        if ($status === null) {
            goto after_status;
        }
        $status = $status->value;        after_status:        $result['status'] = $status;

        
        $external = $object->external();

        if ($external === null) {
            goto after_external;
        }
        after_external:        $result['external'] = $external;

        
        $isExternal = $object->isExternal();
        after_isExternal:        $result['is_external'] = $isExternal;

        
        $contexts = $object->contexts();

        if ($contexts === null) {
            goto after_contexts;
        }
        $contexts = $this->serializeObjectCCTSDKMediaManagementViewModelContextCollection($contexts);
        after_contexts:        $result['contexts'] = $contexts;

        
        $type = $object->type();

        if ($type === null) {
            goto after_type;
        }
        $type = $type->value;        after_type:        $result['type'] = $type;

        
        $endpoint = $object->endpoint();

        if ($endpoint === null) {
            goto after_endpoint;
        }
        after_endpoint:        $result['endpoint'] = $endpoint;

        
        $fileFormat = $object->fileFormat();

        if ($fileFormat === null) {
            goto after_fileFormat;
        }
        after_fileFormat:        $result['file_format'] = $fileFormat;

        
        $originalUri = $object->originalUri();

        if ($originalUri === null) {
            goto after_originalUri;
        }
        after_originalUri:        $result['original_uri'] = $originalUri;

        
        $baseMedia = $object->baseMedia;
        $baseMedia = $this->serializeObjectCCTSDKMediaManagementViewModelBaseMedia($baseMedia);
        after_baseMedia:        $result['id'] = $baseMedia['id'];        $result['name'] = $baseMedia['name'];        $result['description'] = $baseMedia['description'];        $result['private'] = $baseMedia['private'];        $result['extension'] = $baseMedia['extension'];        $result['status'] = $baseMedia['status'];        $result['external'] = $baseMedia['external'];        $result['contexts'] = $baseMedia['contexts'];        $result['type'] = $baseMedia['type'];        $result['endpoint'] = $baseMedia['endpoint'];        $result['file_format'] = $baseMedia['file_format'];        $result['original_uri'] = $baseMedia['original_uri'];
        
        $contentSize = $object->contentSize;

        if ($contentSize === null) {
            goto after_contentSize;
        }
        after_contentSize:        $result['content_size'] = $contentSize;


        return $result;
    }

    
    private function serializeObjectCCTSDKMediaManagementViewModelMediaImage(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\MediaManagement\ViewModel\MediaImage);
        $result = [];
        
        $baseMedia = $object->baseMedia;
        $baseMedia = $this->serializeObjectCCTSDKMediaManagementViewModelBaseMedia($baseMedia);
        after_baseMedia:        $result['id'] = $baseMedia['id'];        $result['name'] = $baseMedia['name'];        $result['description'] = $baseMedia['description'];        $result['private'] = $baseMedia['private'];        $result['extension'] = $baseMedia['extension'];        $result['status'] = $baseMedia['status'];        $result['external'] = $baseMedia['external'];        $result['contexts'] = $baseMedia['contexts'];        $result['type'] = $baseMedia['type'];        $result['endpoint'] = $baseMedia['endpoint'];        $result['file_format'] = $baseMedia['file_format'];        $result['original_uri'] = $baseMedia['original_uri'];
        
        $contentSize = $object->contentSize;

        if ($contentSize === null) {
            goto after_contentSize;
        }
        after_contentSize:        $result['content_size'] = $contentSize;

        
        $width = $object->width;

        if ($width === null) {
            goto after_width;
        }
        after_width:        $result['width'] = $width;

        
        $height = $object->height;

        if ($height === null) {
            goto after_height;
        }
        after_height:        $result['height'] = $height;


        return $result;
    }

    
    private function serializeObjectCCTSDKMediaManagementViewModelMediaVideo(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\MediaManagement\ViewModel\MediaVideo);
        $result = [];
        
        $baseMedia = $object->baseMedia;
        $baseMedia = $this->serializeObjectCCTSDKMediaManagementViewModelBaseMedia($baseMedia);
        after_baseMedia:        $result['id'] = $baseMedia['id'];        $result['name'] = $baseMedia['name'];        $result['description'] = $baseMedia['description'];        $result['private'] = $baseMedia['private'];        $result['extension'] = $baseMedia['extension'];        $result['status'] = $baseMedia['status'];        $result['external'] = $baseMedia['external'];        $result['contexts'] = $baseMedia['contexts'];        $result['type'] = $baseMedia['type'];        $result['endpoint'] = $baseMedia['endpoint'];        $result['file_format'] = $baseMedia['file_format'];        $result['original_uri'] = $baseMedia['original_uri'];
        
        $contentSize = $object->contentSize;

        if ($contentSize === null) {
            goto after_contentSize;
        }
        after_contentSize:        $result['content_size'] = $contentSize;

        
        $width = $object->width;

        if ($width === null) {
            goto after_width;
        }
        after_width:        $result['width'] = $width;

        
        $height = $object->height;

        if ($height === null) {
            goto after_height;
        }
        after_height:        $result['height'] = $height;

        
        $duration = $object->duration;

        if ($duration === null) {
            goto after_duration;
        }
        after_duration:        $result['duration'] = $duration;

        
        $frameRate = $object->frameRate;

        if ($frameRate === null) {
            goto after_frameRate;
        }
        after_frameRate:        $result['frame_rate'] = $frameRate;

        
        $posterUrl = $object->posterUrl;

        if ($posterUrl === null) {
            goto after_posterUrl;
        }
        after_posterUrl:        $result['poster_url'] = $posterUrl;


        return $result;
    }

    
    private function serializeObjectCCTSDKMediaManagementViewModelSearchResult(mixed $object): mixed
    {
        \assert($object instanceof \CCT\SDK\MediaManagement\ViewModel\SearchResult);
        $result = [];
        
        $total = $object->total;
        after_total:        $result['total'] = $total;

        
        $data = $object->data;
        static $dataSerializer0;

        if ($dataSerializer0 === null) {
            $dataSerializer0 = new \CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject(...array (
  0 => 'CCT\\SDK\\MediaManagement\\ViewModel\\MediaCollection',
));
        }
        
        $data = $dataSerializer0->serialize($data, $this);
        after_data:        $result['data'] = $data;

        
        $page = $object->page;
        after_page:        $result['page'] = $page;

        
        $itemsPerPage = $object->itemsPerPage;
        after_itemsPerPage:        $result['items_per_page'] = $itemsPerPage;

        
        $pageCount = $object->pageCount;
        after_pageCount:        $result['page_count'] = $pageCount;


        return $result;
    }
    
    

    /**
     * @template T
     *
     * @param class-string<T> $className
     * @param iterable<array> $payloads;
     *
     * @return IterableList<T>
     *
     * @throws UnableToHydrateObject
     */
    public function hydrateObjects(string $className, iterable $payloads): IterableList
    {
        return new IterableList($this->doHydrateObjects($className, $payloads));
    }

    private function doHydrateObjects(string $className, iterable $payloads): Generator
    {
        foreach ($payloads as $index => $payload) {
            yield $index => $this->hydrateObject($className, $payload);
        }
    }

    /**
     * @template T
     *
     * @param class-string<T> $className
     * @param iterable<array> $payloads;
     *
     * @return IterableList<T>
     *
     * @throws UnableToSerializeObject
     */
    public function serializeObjects(iterable $payloads): IterableList
    {
        return new IterableList($this->doSerializeObjects($payloads));
    }

    private function doSerializeObjects(iterable $objects): Generator
    {
        foreach ($objects as $index => $object) {
            yield $index => $this->serializeObject($object);
        }
    }
}