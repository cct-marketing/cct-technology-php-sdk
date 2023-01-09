<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Functional;

use CCT\SDK\Campaign\Data\AdContent\CampaignImage\CampaignImages;
use CCT\SDK\Campaign\Data\AdContent\Image\ImageCollection;
use CCT\SDK\Campaign\Data\CampaignUuid;
use CCT\SDK\Campaign\Payload\SaveCampaign;
use CCT\SDK\Campaign\Payload\StartCampaign;
use CCT\SDK\CampaignFlow\Data\CampaignFlowUuid;
use CCT\SDK\Client\CctClient;
use CCT\SDK\Customer\Data\CustomerId;
use CCT\SDK\MediaManagement\Request\Media\CreateMediaCollection;
use CCT\SDK\MediaManagement\Request\Media\RemoteMedia;
use CCT\SDK\MediaManagement\ViewModel\MediaCollection;
use CCT\SDK\MediaManagement\ViewModel\MediaType;
use PHPUnit\Framework\TestCase;

final class CreateCampaignRequestTest extends TestCase
{
    public function testCreateCampaign(): void
    {
        $CCTClientMockFactory = new CCTClientMockFactory();
        $cctClient = $CCTClientMockFactory->createCctClient();

        $campaignFlowUuid = CampaignFlowUuid::fromString('27ff5c00-e651-479e-81c2-a92e6957123d');
        $customerId = CustomerId::fromString('7533e424-de27-4e7b-9864-bc8130623391');

        // Start Campaign
        $startCampaign = StartCampaign::fromArray(['campaign_flow_uuid' => $campaignFlowUuid->toString()]);
        $campaignCreationResponse = $cctClient->campaignClient()->startCampaign($startCampaign, $customerId);

        // Add images to service with campaign id context
        $mediaCollection = $this->addImagesToCampaignMediaLibrary($customerId, $campaignCreationResponse->uuid, $cctClient);

        $images = ImageCollection::fromMediaCollection($mediaCollection);
        $campaignImages = CampaignImages::fromImages($images);

        // Use images in service
        $addImages = ['ad_content' => ['campaign_images' => $campaignImages->toArray()]];
        // Create Content with images
        $campaignValues = CampaignDataHelper::campaignData($addImages);

        // Save campaign content
        $saveCampaign = SaveCampaign::fromArray($campaignValues);
        $campaignCreationResponse = $cctClient->campaignClient()->saveCampaign($saveCampaign, $customerId, $campaignCreationResponse->uuid);

        // Place campaign
        $campaignCreationResponse = $cctClient->campaignClient()->placeCampaign($customerId, $campaignCreationResponse->uuid);

        $this->assertIsString($campaignCreationResponse->uuid->toString());
    }

    private function addImagesToCampaignMediaLibrary(CustomerId $customerId, CampaignUuid $campaignUuid, CctClient $cctClient): MediaCollection
    {
        $remoteMedia = RemoteMedia::fromArray(
            [
                'remote_file' => 'https://s3.eu-west-1.amazonaws.com/files-staging.cct-marketing.com/media/images/214454d8-1fa9-4670-af28-81ecf3956a04/original.jpeg',
                'type' => MediaType::IMAGE->value,
            ]
        );

        return $cctClient->mediaClient()->createBulkMedia($customerId, $campaignUuid, CreateMediaCollection::fromItems($remoteMedia));
    }
}
