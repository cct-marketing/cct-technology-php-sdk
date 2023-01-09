<?php

declare(strict_types=1);

namespace CCT\SDK\Client;

use CCT\SDK\Client\Options\Options;
use CCT\SDK\Exception\InvalidStatusCodeException;
use CCT\SDK\Infrastucture\ValueObject\AbstractUrlOption;
use GuzzleHttp\Client;

abstract class AbstractServiceClient
{
    public function __construct(protected readonly Options $options, protected readonly Client $client)
    {
    }

    public function listResources(string $uri): array
    {
        $response = $this->client->get($uri);

        if (200 !== $response->getStatusCode()) {
            throw InvalidStatusCodeException::create(202, $response->getStatusCode(), $response->getBody()->getContents());
        }

        return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }

    protected function hostWithPath(string $path): string
    {
        return $this->host()->withPath($path)->toString();
    }

    abstract public function host(): AbstractUrlOption;
}
