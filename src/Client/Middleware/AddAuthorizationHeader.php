<?php

declare(strict_types=1);

namespace CCT\SDK\Client\Middleware;

use CCT\SDK\Infrastructure\Assert\Assertion;
use League\OAuth2\Client\Provider\AbstractProvider as OAuth2Provider;
use League\OAuth2\Client\Token\AccessToken;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;
use Softonic\OAuth2\Guzzle\Middleware\AccessTokenCacheHandler;

final class AddAuthorizationHeader
{
    public function __construct(
        private readonly OAuth2Provider $provider,
        private array $config,
        private readonly AccessTokenCacheHandler $cacheHandler
    ) {
    }

    public function __invoke(RequestInterface $request): RequestInterface
    {
        $this->setCustomerScopeByUri($request->getUri());
        $token = $this->cacheHandler->getTokenByProvider($this->provider, $this->config);
        if (false === $token) {
            $accessToken = $this->getAccessToken();
            $token = $accessToken->getToken();
            $this->cacheHandler->saveTokenByProvider($accessToken, $this->provider, $this->config);
        }

        foreach ($this->provider->getHeaders($token) as $name => $value) {
            $request = $request->withHeader($name, $value);
        }

        return $request;
    }

    private function getAccessToken(): AccessToken
    {
        $options = $this->getOptions();
        $grantType = $this->getGrantType();

        $accessToken = $this->provider->getAccessToken($grantType, $options);

        Assertion::isInstanceOf($accessToken, AccessToken::class, 'auth_header');

        return $accessToken;
    }

    private function getGrantType(): string
    {
        if (empty($this->config['grant_type'])) {
            throw new \InvalidArgumentException('Config value `grant_type` needs to be specified.');
        }

        return $this->config['grant_type'];
    }

    private function getOptions(): array
    {
        $options = [];
        if (!empty($this->config['scope'])) {
            $options['scope'] = $this->config['scope'];
        }

        if (!empty($this->config['token_options'])) {
            $tokenOptions = $this->config['token_options'];
            foreach ($tokenOptions as $key => $value) {
                $options[$key] = $value;
            }
        }

        return $options;
    }

    private function setCustomerScopeByUri(UriInterface $uri): void
    {
        $uuid = $this->extractCustomerIdFromUri($uri);

        if (null === $uuid) {
            return;
        }

        $currentScope = $this->config['scope'] ?? '';

        if (!isset($this->config['token_options'])) {
            $this->config['token_options'] = [];
        }

        $this->config['token_options']['scope'] = trim(sprintf('%s customer_%s', $currentScope, $uuid));
    }

    private function extractCustomerIdFromUri(UriInterface $uri): ?string
    {
        $url = $uri->getPath();

        $matches = [];
        preg_match('/^\/customers\/([a-f0-9]{8}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12})/', $url, $matches);

        return $matches[1] ?? null;
    }
}
