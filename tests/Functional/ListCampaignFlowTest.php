<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Functional;

use CCT\SDK\Customer\Data\CustomerId;
use PHPUnit\Framework\TestCase;

final class ListCampaignFlowTest extends TestCase
{
    public function testListCampaignFlowsForCustomer(): void
    {
        $clientMockFactory = new CCTClientMockFactory();
        $client = $clientMockFactory->createCctClient();

        $customerId = CustomerId::fromString('7533e424-de27-4e7b-9864-bc8130623391');

        $listResult = $client->campaignFlowClient()->list($customerId);
        $this->assertGreaterThan(1, $listResult->count());
    }
}
