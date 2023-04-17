<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Functional;

use CCT\SDK\Campaign\Data\AdContent\CampaignImage\CampaignImages;
use CCT\SDK\Campaign\Data\AdContent\Image\ImageCollection;
use CCT\SDK\Campaign\Data\CampaignId;
use CCT\SDK\Campaign\Payload\SaveCampaign;
use CCT\SDK\Campaign\Payload\StartCampaign;
use CCT\SDK\CampaignFlow\Data\CampaignFlowId;
use CCT\SDK\Client\Client;
use CCT\SDK\Customer\Data\CustomerId;
use CCT\SDK\MediaManagement\Request\Media\CreateMediaCollection;
use CCT\SDK\MediaManagement\Request\Media\RemoteMedia;
use CCT\SDK\MediaManagement\ViewModel\MediaCollection;
use CCT\SDK\MediaManagement\ViewModel\MediaType;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

final class CreateCampaignRequestTest extends TestCase
{
    public function testCreateCampaign(): void
    {
        $clientMockFactory = new CCTClientMockFactory();
        $mock = new MockHandler(
            [
                // Start Campaign
                new Response(201, [], file_get_contents(__DIR__ . '/Fixtures/campaign_common_response.json')),
                // Add images to service with campaign id context
                new Response(201, [], file_get_contents(__DIR__ . '/Fixtures/media_collection_creation_response.json')),
                // Mutate Campaign content
                new Response(200, [], file_get_contents(__DIR__ . '/Fixtures/campaign_common_response.json')),
                // Place Campaign
                new Response(202, [], file_get_contents(__DIR__ . '/Fixtures/campaign_common_response.json')),
            ]
        );

        $client = $clientMockFactory->createClientWithMock($mock);

        $campaignFlowUuid = CampaignFlowId::fromString('27ff5c00-e651-479e-81c2-a92e6957123d');
        $customerId = CustomerId::fromString('7533e424-de27-4e7b-9864-bc8130623391');

        // Start Campaign
        $startCampaign = StartCampaign::fromArray(['campaign_flow_uuid' => $campaignFlowUuid->toString()]);
        $campaignCreationResponse = $client->campaignClient()->startCampaign($startCampaign, $customerId);

        // Add images to service with campaign id context
        $mediaCollection = $this->addImagesToCampaignMediaLibrary($customerId, $campaignCreationResponse->campaignId, $client);

        $images = ImageCollection::fromMediaCollection($mediaCollection);
        $campaignImages = CampaignImages::fromImages($images);

        // Use images in service
        $addImages = ['ad_content' => ['campaign_images' => $campaignImages->toArray()]];
        // Create Content with images
        $campaignValues = CampaignDataHelper::campaignData($addImages);

        // Save campaign content
        $saveCampaign = SaveCampaign::fromArray($campaignValues);
        $campaignCreationResponse = $client->campaignClient()->saveCampaign($saveCampaign, $customerId, $campaignCreationResponse->campaignId);

        // Place campaign
        $campaignCreationResponse = $client->campaignClient()->placeCampaign($customerId, $campaignCreationResponse->campaignId);

        $this->assertIsString($campaignCreationResponse->campaignId->toString());
    }

    private function addImagesToCampaignMediaLibrary(CustomerId $customerId, CampaignId $campaignUuid, Client $client): MediaCollection
    {
        $remoteMedia = RemoteMedia::fromArray(
            [
                'remote_file' => 'https://s3.eu-west-1.amazonaws.com/files-staging.cct-marketing.com/media/images/214454d8-1fa9-4670-af28-81ecf3956a04/original.jpeg',
                'type' => MediaType::IMAGE->value,
            ]
        );

        return $client->mediaClient()->createBulkMedia($customerId, $campaignUuid, CreateMediaCollection::fromItems($remoteMedia));
    }
}
