<?php

declare(strict_types=1);

namespace CCT\SDK\Client;

use CCT\SDK\Client\Options\Options;
use CCT\SDK\Exception\ApiRequestException;
use CCT\SDK\Exception\InvalidStatusCodeException;
use CCT\SDK\Infrastructure\ValueObject\AbstractUrlOption;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\MessageInterface;

abstract class AbstractServiceClient
{
    public function __construct(protected readonly Options $options, protected readonly Client $client)
    {
    }

    protected function listResources(string $uri): array
    {
        $request = new Request('GET', $uri);

        return $this->sendJsonRequest($request, 200);
    }

    abstract public function host(): AbstractUrlOption;

    protected function sendJsonRequest(Request $request, int|array $expectedStatusCode, array $options = []): array
    {
        $request->withAddedHeader('Content-Type', 'application/json');

        $response = $this->sentRequest($request, $expectedStatusCode, $options);

        return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }

    protected function sentRequest(Request $request, int|array $expectedStatusCode, array $options = []): MessageInterface
    {
        $requestWithHost = $request->withUri(
            $request->getUri()
                ->withScheme($this->host()->scheme())
                ->withHost($this->host()->host())
                ->withPort($this->host()->port())
        );

        try {
            $response = $this->client->send($requestWithHost, $this->withDefaultOptions($options));
        } catch (ClientExceptionInterface $exception) {
            throw ApiRequestException::createFrom($exception);
        }
        $expectedStatusCodes = is_array($expectedStatusCode) ? $expectedStatusCode : [$expectedStatusCode];
        if (!in_array($response->getStatusCode(), $expectedStatusCodes, true)) {
            throw InvalidStatusCodeException::create($expectedStatusCodes, $response->getStatusCode(), $response->getBody()->getContents());
        }

        return $response;
    }

    private function withDefaultOptions(array $options): array
    {
        return array_merge(
            [
                RequestOptions::DEBUG => $this->options->debug,
                RequestOptions::HTTP_ERRORS => false,
            ],
            $options
        );
    }
}
