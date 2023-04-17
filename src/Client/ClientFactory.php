<?php

declare(strict_types=1);

namespace CCT\SDK\Client;

use CCT\SDK\Client\AuthProvider\Provider;
use CCT\SDK\Client\Middleware\ClientBuilder;
use CCT\SDK\Client\Options\Options;
use Psr\Cache\CacheItemPoolInterface;

final class ClientFactory
{
    public static function create(Options $options, CacheItemPoolInterface $cache, array $guzzleOptions = [], array $collaborators = []): Client
    {
        $provider = new Provider($options->toArray(), $collaborators);

        $config = ['grant_type' => 'client_credentials', 'scope' => 'cct-api'];

        $client = ClientBuilder::build($provider, $config, $cache, $guzzleOptions);

        return new Client($options, $client);
    }
}
