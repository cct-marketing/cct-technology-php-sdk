<?php

namespace CCT\SDK\Tests\Unit\Campaign\Response;

use CCT\SDK\Campaign\Data\CampaignUuid;
use CCT\SDK\Campaign\Response\CommonMutateResponse;
use CCT\SDK\Infrastucture\Assert\Exception\AssertionFailedException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class CommonMutateResponseTest extends TestCase
{
    public function testCreateFromResponse(): void
    {
        $mockResponse = $this->createMock(ResponseInterface::class);

        $mockBody = $this->createMock(StreamInterface::class);
        $mockBody->method('getContents')
            ->willReturn('{"uuid": "12345678-1234-1234-1234-123456789012"}');

        $mockResponse->method('getBody')
            ->willReturn($mockBody);

        $response = CommonMutateResponse::createFromResponse($mockResponse);
        $this->assertInstanceOf(CommonMutateResponse::class, $response);
        $this->assertInstanceOf(CampaignUuid::class, $response->uuid);
        $this->assertEquals('12345678-1234-1234-1234-123456789012', $response->uuid->toString());
    }

    public function testCreateFromResponseWithInvalidData(): void
    {
        $this->expectException(AssertionFailedException::class);

        $mockResponse = $this->createMock(ResponseInterface::class);

        $mockBody = $this->createMock(StreamInterface::class);
        $mockBody->method('getContents')
            ->willReturn('{"invalid_key": "12345678-1234-1234-1234-123456789012"}');

        $mockResponse->method('getBody')
            ->willReturn($mockBody);

        CommonMutateResponse::createFromResponse($mockResponse);
    }
}
