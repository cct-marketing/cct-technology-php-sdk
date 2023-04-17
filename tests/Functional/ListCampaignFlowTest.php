<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Functional;

use CCT\SDK\Customer\Data\CustomerId;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

final class ListCampaignFlowTest extends TestCase
{
    public function testListCampaignFlowsForCustomer(): void
    {
        $clientMockFactory = new CCTClientMockFactory();
        $mock = new MockHandler(
            [
                // Get Campaign flows/Products
                new Response(200, [], file_get_contents(__DIR__ . '/Fixtures/campaign_flow_products_response.json')),
            ]
        );

        $client = $clientMockFactory->createClientWithMock($mock);

        $customerId = CustomerId::fromString('7533e424-de27-4e7b-9864-bc8130623391');

        $listResult = $client->campaignFlowClient()->list($customerId);
        $this->assertGreaterThan(1, $listResult->count());
    }
}
