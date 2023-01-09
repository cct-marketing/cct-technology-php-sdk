<?php

declare(strict_types=1);

namespace CCT\SDK\Customer;

use CCT\SDK\Client\Options\Options;
use CCT\SDK\Customer\Response\ListResult;
use CCT\SDK\MediaManagement\Exception\InvalidStatusCodeException;
use GuzzleHttp\Client;

final class CustomerClient
{
    public function __construct(private readonly Options $options, private readonly Client $client)
    {
    }

    public function list(): ListResult
    {
        $response = $this->client->request(
            'GET',
            $this->hostWithPath('/api-v2/customers'),
        );

        if ($response->getStatusCode() !== 200) {
            throw InvalidStatusCodeException::create(200, $response->getStatusCode(), (string) $response->getBody());
        }

        $data = json_decode((string) $response->getBody(), true);

        return ListResult::fromArray($data);
    }

    private function hostWithPath(string $path): string
    {
        return $this->options->customerHost->withPath($path)->toString();
    }
}
