<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Functional;

use CCT\SDK\Customer\Data\CustomerId;
use PHPUnit\Framework\TestCase;

final class ListCampaignFlowTest extends TestCase
{
    public function testListCampaignFlowsForCustomer(): void
    {
        $CCTClientMockFactory = new CCTClientMockFactory();
        $cctClient = $CCTClientMockFactory->createCctClient();

        $customerId = CustomerId::fromString('24cd6db4-fb56-4f7e-9169-3d543b9e9910');

        $listResult = $cctClient->campaignFlowClient()->list($customerId);
        $this->assertGreaterThan(1, $listResult->count());
    }
}
