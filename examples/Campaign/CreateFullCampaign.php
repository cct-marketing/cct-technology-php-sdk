<?php

declare(strict_types=1);

namespace CCT\SDK\Examples\Campaign;

require __DIR__ . '/../../vendor/autoload.php';

use CCT\SDK\Campaign\Data\AdContent\AdContent;
use CCT\SDK\Campaign\Data\AdContent\CampaignImage\CampaignImages;
use CCT\SDK\Campaign\Data\AdContent\Image\ImageCollection;
use CCT\SDK\Campaign\Data\CampaignId;
use CCT\SDK\Campaign\Data\Details\Details;
use CCT\SDK\Campaign\Data\Targeting\Targeting;
use CCT\SDK\Campaign\Payload\SaveCampaign;
use CCT\SDK\Campaign\Payload\StartCampaign;
use CCT\SDK\CampaignFlow\Data\CampaignFlowId;
use CCT\SDK\Client\CctClient;
use CCT\SDK\Client\CctClientFactory;
use CCT\SDK\Customer\Data\CustomerId;
use CCT\SDK\Examples\OptionsForExamples;
use CCT\SDK\Exception\ApiRequestException;
use CCT\SDK\MediaManagement\Request\Media\CreateMediaCollection;
use CCT\SDK\MediaManagement\Request\Media\RemoteMedia;
use CCT\SDK\MediaManagement\ViewModel\MediaCollection;
use CCT\SDK\MediaManagement\ViewModel\MediaType;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use CCT\SDK\Campaign\Data\Options\Options as CampaignOptions;

final class CreateFullCampaign
{
    public static function main(): void
    {
        $option = OptionsForExamples::create();

        // See ListAccessibleCustomers.php to get the list of customer id you have access too
        $customerId = CustomerId::fromString('{CUSTOMER_ID}'); // Specify the Customer ID for the campaign you wish to create.

        // See ListProductsForCustomer.php to see how to get a product for this customer it has access to
        $campaignFlowId = CampaignFlowId::fromString('{CUSTOMER_CAMPAIGN_FLOW_ID}'); // Specify the product the campaign will be initialised with.

        $cache = new ArrayAdapter();
        $cctClient = CctClientFactory::create($option, $cache);

        try {
            // This will initialize a campaign for specific product and return a campaign uuid
            $campaignId = self::startCampaign($cctClient, $customerId, $campaignFlowId);

            // This action will incorporate assets into the system and link them to the specified campaign.
            // Note that this does not select which assets will be utilized.
            $images = self::addMediaAssets($cctClient, $customerId, $campaignId);

            // Establish the campaign details, define the ad content, and ad targeting criteria.
            self::setCampaignData($cctClient, $customerId, $campaignId, $images);

            // Places the campaign and upon review will deploys it into the appropriate advertising channels
            self::placeCampaign($cctClient, $customerId, $campaignId);
        } catch (IdentityProviderException $e) {
            printf('Auth error: %s', $e->getMessage());
            exit(1);
        }
    }

    private static function startCampaign(CctClient $cctClient, CustomerId $customerId, CampaignFlowId $campaignFlowId): CampaignId
    {
        // Start Campaign creation
        $startCampaign = new StartCampaign($campaignFlowId);
        $campaignCreationResponse = $cctClient->campaignClient()->startCampaign($startCampaign, $customerId);

        printf('Campaign with id "%s" initialized.%s', $campaignCreationResponse->campaignId->toString(), PHP_EOL);

        return $campaignCreationResponse->campaignId;
    }

    private static function addMediaAssets(CctClient $cctClient, CustomerId $customerId, CampaignId $campaignId): MediaCollection
    {
        $remoteMedia = RemoteMedia::fromArray(
            [
                'remote_file' => 'https://s3.eu-west-1.amazonaws.com/files-staging.cct-marketing.com/media/images/214454d8-1fa9-4670-af28-81ecf3956a04/original.jpeg',
                'type' => MediaType::IMAGE->value,
            ]
        );

        try {
            $images = $cctClient->mediaClient()->createBulkMedia($customerId, $campaignId, CreateMediaCollection::fromItems($remoteMedia));
        } catch (ApiRequestException $requestException) {
            printf('Campaign with uuid "%s" failed to save with error %s', $requestException->getMessage(), PHP_EOL);
            exit(1);
        }

        printf('Image uploaded to the system form campaign "%s": %d%s', $campaignId->toString(), $images->count(), PHP_EOL);

        return $images;
    }

    private static function setCampaignData(CctClient $cctClient, CustomerId $customerId, CampaignId $campaignId, MediaCollection $images): void
    {
        $details = self::createCampaignDetails();
        $adContent = self::createCampaignAdContent($images);
        $targeting = self::createCampaignTargeting();
        $options = self::createCampaignOptions();

        // Save campaign content
        $saveCampaign = new SaveCampaign($details, $adContent, $targeting, $options);
        try {
            $cctClient->campaignClient()->saveCampaign($saveCampaign, $customerId, $campaignId);
        } catch (ApiRequestException $requestException) {
            printf('Campaign with uuid "%s" failed to save with error %s', $requestException->getMessage(), PHP_EOL);
            exit(1);
        }

        printf('Campaign with uuid "%s" saved %s', $campaignId->toString(), PHP_EOL);
    }

    private static function createCampaignDetails(): Details
    {
        $startDate = (new \DateTimeImmutable())->modify('+ 2 days');
        $endDate = (new \DateTimeImmutable())->modify('+ 12 days');

        return Details::fromArray(
            [
                'campaign_title' => 'Test of campaign sdk',
                'campaign_period' => [
                    'start_date' => $startDate->format('Y-m-d'),
                    'end_date' => $endDate->format('Y-m-d'),
                ],
                'landing_page' => 'http://test.com',
            ]
        );
    }

    private static function createCampaignAdContent(MediaCollection $images): AdContent
    {
        $images = ImageCollection::fromMediaCollection($images);
        $campaignImages = CampaignImages::fromImages($images);

        return AdContent::fromArray(
            [
                'campaign_images' => $campaignImages->toArray(),
                'facebook_ai_multi_ad_variants' => [
                    [
                        'texts' => ['text 1', 'text 2', 'text 3'],
                        'headings' => ['heading 1', 'heading 2', 'heading 3'],
                        'descriptions' => ['description 1', 'description 2', 'description 3'],
                    ],
                ],
            ]
        );
    }

    private static function createCampaignTargeting(): Targeting
    {
        return Targeting::fromArray(
            [
                'locations' => [
                    [
                        'address' => '55 Fruit St, Boston, MA 02114, USA',
                        'coordinate' => [
                            'latitude' => 42.36308280000001,
                            'longitude' => -71.0686204,
                        ],
                        'radius' => [
                            'radius' => 20,
                            'measurement_unit' => 'km',
                        ],
                    ],
                ],
                'industry_address' => [
                    'address' => [
                        'formatted_address' => '55 Fruit St, Boston, MA 02114, USA',
                    ],
                    'coordinate' => [
                        'latitude' => 42.36308280000001,
                        'longitude' => -71.0686204,
                    ],
                ],
                'property_information' => [
                    'property_price' => 120000000,
                    'property_size' => 40000,
                    'number_of_bedrooms' => 5,
                ],
            ]
        );
    }

    private static function createCampaignOptions(): CampaignOptions
    {
        return CampaignOptions::fromArray(
            [
                'post_first_variant_to_facebook' => ['enabled' => true],
            ]
        );
    }

    private static function placeCampaign(CctClient $cctClient, CustomerId $customerId, CampaignId $campaignId): void
    {
        $cctClient->campaignClient()->placeCampaign($customerId, $campaignId);

        printf('Campaign with uuid "%s" has been placed.%s', $campaignId->toString(), PHP_EOL);
    }
}
CreateFullCampaign::main();
