<?php

namespace CCT\SDK\Tests\Unit\Client\AuthProvider;

use CCT\SDK\Client\AuthProvider\Provider;
use CCT\SDK\Infrastructure\Assert\Exception\AssertionFailedException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class ProviderTest extends TestCase
{
    public function textMissingClientIdThrowsAssertionFailedException(): void
    {
        $this->expectException(AssertionFailedException::class);
        $options = [
            'oauth_host' => 'https://oauth.service.com',
            'client_secret' => 'test',
        ];
        new Provider($options);
    }

    public function textMissingClientSecretThrowsAssertionFailedException(): void
    {
        $this->expectException(AssertionFailedException::class);
        $options = [
            'oauth_host' => 'https://oauth.service.com',
            'client_id' => 'test',
        ];
        new Provider($options);
    }

    public function testGetBaseAuthorizationUrl(): void
    {
        $options = $this->validOptions();
        $provider = new Provider($options);
        $this->assertSame('https://oauth.service.com/api-v2/auth/authorize', $provider->getBaseAuthorizationUrl());
    }

    public function testGetBaseAccessTokenUrl(): void
    {
        $options = $this->validOptions();
        $provider = new Provider($options);
        $params = [];
        $this->assertSame('https://oauth.service.com/api-v2/auth/token', $provider->getBaseAccessTokenUrl($params));
    }

    public function testCheckResponse(): void
    {
        $this->expectException(IdentityProviderException::class);

        $request = new Request('GET', '/test');

        $response = $this->createMock(ResponseInterface::class);

        $stream = $this->createMock(StreamInterface::class);
        $stream->method('__toString')->willReturn('{"error_description":"Some error occurred."}');
        $response->method('getBody')->willReturn($stream);
        $response->method('getStatusCode')->willReturn(400);

        $options = $this->validOptions();

        $provider = new Provider($options);

        $mock = new MockHandler(
            [
                new BadResponseException('error', $request, $response),
            ]
        );

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $provider->setHttpClient($client);

        $provider->getParsedResponse($request);
    }

    private function validOptions(): array
    {
        return [
            'oauth_host' => 'https://oauth.service.com',
            'client_id' => 'test',
            'client_secret' => 'test',
        ];
    }
}
