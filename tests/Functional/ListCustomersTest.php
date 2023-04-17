<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Functional;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

final class ListCustomersTest extends TestCase
{
    public function testListCustomers(): void
    {
        $clientMockFactory = new CCTClientMockFactory();
        $mock = new MockHandler(
            [
                // Get Campaign flows/Products
                new Response(200, [], file_get_contents(__DIR__ . '/Fixtures/list_customers_response.json')),
            ]
        );

        $client = $clientMockFactory->createClientWithMock($mock);

        $listResult = $client->customerClient()->list();

        $this->assertGreaterThanOrEqual(1, $listResult->count());
    }
}
