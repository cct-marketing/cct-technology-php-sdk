<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Functional;

use CCT\SDK\Customer\Data\CustomerId;
use CCT\SDK\MediaManagement\Request\Media\BaseMediaCreate;
use CCT\SDK\MediaManagement\Request\Media\UploadMedia;
use CCT\SDK\MediaManagement\ViewModel\MediaInterface;
use CCT\SDK\MediaManagement\ViewModel\MediaType;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

final class UploadMediaTest extends TestCase
{
    public function testUploadMediaSendsMultipartRequestAndReturnsMediaItem(): void
    {
        $clientMockFactory = new CCTClientMockFactory();

        $mock = new MockHandler([
            new Response(201, [], file_get_contents(__DIR__ . '/Fixtures/media_creation_response.json')),
        ]);

        $history = [];
        $client = $clientMockFactory->createClientWithMockAndHistory($mock, $history);

        $customerId = CustomerId::fromString('7533e424-de27-4e7b-9864-bc8130623391');

        $fileResource = fopen(__DIR__ . '/assets/test_image.jpg', 'rb');
        self::assertIsResource($fileResource);

        try {
            $baseMediaCreate = BaseMediaCreate::fromArray([
                'name' => 'test image',
                'type' => MediaType::IMAGE->value,
            ]);

            $uploadMedia = new UploadMedia($baseMediaCreate, $fileResource, 'test_image.jpg');

            $mediaItem = $client->mediaClient()->uploadMedia($customerId, $uploadMedia);

            self::assertInstanceOf(MediaInterface::class, $mediaItem);

            self::assertCount(1, $history, 'Exactly one HTTP request should have been sent');
            $sentRequest = $history[0]['request'];

            self::assertSame('POST', $sentRequest->getMethod());
            self::assertSame(
                sprintf('/customers/%s/medium', $customerId->toString()),
                $sentRequest->getUri()->getPath()
            );

            $contentType = $sentRequest->getHeaderLine('Content-Type');
            self::assertStringStartsWith(
                'multipart/form-data',
                $contentType,
                'Expected multipart/form-data Content-Type, got: ' . $contentType
            );

            $body = (string) $sentRequest->getBody();
            self::assertStringContainsString('name="media[file]"', $body);
            self::assertStringContainsString('filename="test_image.jpg"', $body);
            self::assertStringContainsString('name="media[type]"', $body);
            self::assertStringContainsString('name="media[name]"', $body);
        } finally {
            fclose($fileResource);
        }
    }
}
