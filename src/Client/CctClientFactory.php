<?php

declare(strict_types=1);

namespace CCT\SDK\Client;

use CCT\SDK\Client\AuthProvider\Provider;
use CCT\SDK\Client\Middleware\ClientBuilder;
use CCT\SDK\Client\Options\Options;
use Psr\Cache\CacheItemPoolInterface;

final class CctClientFactory
{
    public static function create(Options $options, CacheItemPoolInterface $cache): CctClient
    {
        $provider = new Provider($options->toArray());

        $config = ['grant_type' => 'client_credentials', 'scope' => 'cct-api'];

        $client = ClientBuilder::build($provider, $config, $cache, ['']);

        return new CctClient($options, $client);
    }
}
