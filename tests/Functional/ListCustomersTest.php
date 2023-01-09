<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Functional;

use PHPUnit\Framework\TestCase;

final class ListCustomersTest extends TestCase
{
    public function testListCustomers(): void
    {
        $CCTClientMockFactory = new CCTClientMockFactory();
        $cctClient = $CCTClientMockFactory->createCctClient();

        $listResult = $cctClient->customerClient()->list();

        $this->assertGreaterThan(1, $listResult->count());
    }
}
