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
use CCT\SDK\Client\Client;
use CCT\SDK\Client\ClientFactory;
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

final class CreateFullCampaignWithMultipleSaves
{
    public static function main(): void
    {
        $option = OptionsForExamples::create();

        // See ListAccessibleCustomers.php to get the list of customer id you have access too
        $customerId = CustomerId::fromString('{CUSTOMER_ID}'); // Specify the Customer ID for the campaign you wish to create.

        $cache = new ArrayAdapter();
        $client = ClientFactory::create($option, $cache);

        try {
            // This will initialize a campaign for specific product and return a campaign uuid
            $campaignId = self::startCampaign($client, $customerId);

            // This will add assets to the system and associate them with the campaign (this will not selected the assets)
            $images = self::addMediaAssets($client, $customerId, $campaignId);

            // Create the campaign details, ad content and ad targeting
            self::setAdContent($client, $customerId, $campaignId, $images);

            self::placeCampaign($client, $customerId, $campaignId);
        } catch (IdentityProviderException $e) {
            printf('Auth error: %s', $e->getMessage());
            exit(1);
        }
    }

    private static function startCampaign(Client $client, CustomerId $customerId): CampaignId
    {
        // See ListProductsForCustomer.php to see how to get a product for this customer it has access to
        $campaignFlowUuid = CampaignFlowId::fromString('27ff5c00-e651-479e-81c2-a92e6957123d');

        // Start Campaign creation
        $startCampaign = StartCampaign::fromArray(['campaign_flow_uuid' => $campaignFlowUuid->toString()]);
        $campaignCreationResponse = $client->campaignClient()->startCampaign($startCampaign, $customerId);

        printf('Campaign with id "%s" initialized.%s', $campaignCreationResponse->campaignId->toString(), PHP_EOL);

        return $campaignCreationResponse->campaignId;
    }

    private static function addMediaAssets(Client $client, CustomerId $customerId, CampaignId $campaignId): MediaCollection
    {
        $remoteMedia = RemoteMedia::fromArray(
            [
                'remote_file' => 'https://s3.eu-west-1.amazonaws.com/files-staging.cct-marketing.com/media/images/214454d8-1fa9-4670-af28-81ecf3956a04/original.jpeg',
                'type' => MediaType::IMAGE->value,
            ]
        );

        try {
            $images = $client->mediaClient()->createBulkMedia($customerId, $campaignId, CreateMediaCollection::fromItems($remoteMedia));
        } catch (ApiRequestException $requestException) {
            printf('Campaign with uuid "%s" failed to save with error %s', $requestException->getMessage(), PHP_EOL);
            exit(1);
        }

        printf('Image uploaded to the system form campaign "%s": %d%s', $campaignId->toString(), $images->count(), PHP_EOL);

        return $images;
    }

    private static function setAdContent(Client $client, CustomerId $customerId, CampaignId $campaignId, MediaCollection $images): void
    {
        $details = self::createCampaignDetails();
        $adContent = self::createCampaignAdContent($images);
        $targeting = self::createCampaignTargeting();
        $options = self::createCampaignOptions();

        // Save campaign content
        $saveCampaign = new SaveCampaign($details, null, null, null);
        self::saveCampaign($client, $saveCampaign, $customerId, $campaignId);

        $saveCampaign = new SaveCampaign(null, $adContent, null, null);
        self::saveCampaign($client, $saveCampaign, $customerId, $campaignId);

        $saveCampaign = new SaveCampaign(null, null, $targeting, null);
        self::saveCampaign($client, $saveCampaign, $customerId, $campaignId);

        $saveCampaign = new SaveCampaign(null, null, null, $options);
        self::saveCampaign($client, $saveCampaign, $customerId, $campaignId);
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

    private static function placeCampaign(Client $client, CustomerId $customerId, CampaignId $campaignId): void
    {
        try {
            $client->campaignClient()->placeCampaign($customerId, $campaignId);
        } catch (ApiRequestException $requestException) {
            printf('Campaign with uuid "%s" failed to save with error %s', $requestException->getMessage(), PHP_EOL);
            exit(1);
        }
        printf('Campaign with uuid "%s" has been placed.%s', $campaignId->toString(), PHP_EOL);
    }

    private static function saveCampaign(Client $client, SaveCampaign $saveCampaign, CustomerId $customerId, CampaignId $campaignId): void
    {
        try {
            $client->campaignClient()->saveCampaign($saveCampaign, $customerId, $campaignId);
        } catch (ApiRequestException $requestException) {
            printf('Campaign with uuid "%s" failed to save with error %s', $requestException->getMessage(), PHP_EOL);
            exit(1);
        }

        printf('Campaign with uuid "%s" saved %s', $campaignId->toString(), PHP_EOL);
    }
}
CreateFullCampaignWithMultipleSaves::main();
