<?php

declare(strict_types=1);

namespace CCT\SDK\Client\Middleware;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use League\OAuth2\Client\Provider\AbstractProvider as OAuth2Provider;
use Softonic\OAuth2\Guzzle\Middleware\AccessTokenCacheHandler;

final class ClientBuilder extends \Softonic\OAuth2\Guzzle\Middleware\ClientBuilder
{
    protected static function addHeaderMiddlewareToStack(
        HandlerStack $stack,
        OAuth2Provider $oauthProvider,
        array $tokenOptions,
        AccessTokenCacheHandler $cacheHandler
    ): HandlerStack {
        $addAuthorizationHeader = new AddAuthorizationHeader(
            $oauthProvider,
            $tokenOptions,
            $cacheHandler
        );

        $stack->push(Middleware::mapRequest($addAuthorizationHeader));

        return $stack;
    }
}
