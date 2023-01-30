<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Functional;

use PHPUnit\Framework\TestCase;

final class ListCustomersTest extends TestCase
{
    public function testListCustomers(): void
    {
        $clientMockFactory = new CCTClientMockFactory();
        $client = $clientMockFactory->createCctClient();

        $listResult = $client->customerClient()->list();

        $this->assertGreaterThan(1, $listResult->count());
    }
}
