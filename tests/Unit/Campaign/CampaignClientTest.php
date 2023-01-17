<?php

namespace CCT\SDK\Tests\Unit\Campaign;

use CCT\SDK\Campaign\CampaignClient;
use CCT\SDK\Campaign\Data\CampaignId;
use CCT\SDK\CampaignFlow\Data\CampaignFlowId;
use CCT\SDK\Client\Options\Options;
use GuzzleHttp\Client;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use CCT\SDK\Campaign\Payload\StartCampaign;
use CCT\SDK\Customer\Data\CustomerId;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

final class CampaignClientTest extends TestCase
{
    public function testStartCampaign(): void
    {
        $mockResponse = $this->createMockResponse(
            '{"uuid": "12345678-1234-1234-1234-123456789012"}',
            201
        );

        $client = $this->createMockClient($mockResponse);

        $options = Options::fromArray(['client_id' => 'test', 'client_secret' => 'key']);
        $campaignClient = new CampaignClient($options, $client);

        $startCampaign = new StartCampaign(CampaignFlowId::fromString('f4b69771-b306-4ee9-9d91-9b7198f52ab3'));

        $response = $campaignClient->startCampaign($startCampaign, CustomerId::fromString('51e13ad1-65ee-4cbb-b3db-65a5ec86e4c1'));

        $this->assertEquals('12345678-1234-1234-1234-123456789012', $response->campaignId->toString());
    }

    public function testPlaceCampaign(): void
    {
        $mockResponse = $this->createMockResponse(
            '{"uuid": "12345678-1234-1234-1234-123456789012"}',
            202
        );

        $client = $this->createMockClient($mockResponse);

        $options = Options::fromArray(['client_id' => 'test', 'client_secret' => 'key']);
        $campaignClient = new CampaignClient($options, $client);

        $response = $campaignClient->placeCampaign(
            CustomerId::fromString('51e13ad1-65ee-4cbb-b3db-65a5ec86e4c1'),
            CampaignId::fromString('12345678-1234-1234-1234-123456789012')
        );

        $this->assertEquals('12345678-1234-1234-1234-123456789012', $response->campaignId->toString());
    }

    private function createMockClient(ResponseInterface|MockObject $mockResponse): Client
    {
        // Create a mock client that will return a predefined response
        $client = $this->createMock(Client::class);
        $client->method('send')->willReturn($mockResponse);

        return $client;
    }

    private function createMockResponse(string $contents, int $statusCode): ResponseInterface|MockObject
    {
        $mockResponse = $this->createMock(ResponseInterface::class);
        $mockResponse->method('getStatusCode')->willReturn($statusCode);
        $mockBody = $this->createMock(StreamInterface::class);
        $mockBody->method('getContents')
            ->willReturn($contents);
        $mockResponse->method('getBody')
            ->willReturn($mockBody);

        return $mockResponse;
    }
}
