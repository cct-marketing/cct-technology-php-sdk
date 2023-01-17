<?php

namespace CCT\SDK\Tests\Unit\Campaign\Response;

use CCT\SDK\Campaign\Data\CampaignId;
use CCT\SDK\Campaign\Response\CommonMutateResponse;
use CCT\SDK\Infrastucture\Assert\Exception\AssertionFailedException;
use PHPUnit\Framework\TestCase;

class CommonMutateResponseTest extends TestCase
{
    public function testCreateFromData(): void
    {
        $data = ['uuid' => '12345678-1234-1234-1234-123456789012'];
        $response = CommonMutateResponse::fromArray($data);

        $this->assertInstanceOf(CampaignId::class, $response->campaignId);
        $this->assertEquals('12345678-1234-1234-1234-123456789012', $response->campaignId->toString());
    }

    public function testCreateFromResponseWithInvalidData(): void
    {
        $this->expectException(AssertionFailedException::class);

        $data = ['invalid_key' => '12345678-1234-1234-1234-123456789012'];

        CommonMutateResponse::fromArray($data);
    }
}
