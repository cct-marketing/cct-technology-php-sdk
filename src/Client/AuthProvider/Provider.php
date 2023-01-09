<?php

declare(strict_types=1);

namespace CCT\SDK\Client\AuthProvider;

use CCT\SDK\Client\Options\OAuthHost;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\ResponseInterface;

final class Provider extends AbstractProvider
{
    use BearerAuthorizationTrait;

    private string $oAuthHost;

    public function __construct(array $options = [], array $collaborators = [])
    {
        $this->oAuthHost = $options['oauth_host'] ?? OAuthHost::createDefault()->toString();
        if (isset($options['client_id'])) {
            $options['clientId'] = $options['client_id'];
        }
        if (isset($options['client_secret'])) {
            $options['clientSecret'] = $options['client_secret'];
        }

        parent::__construct($options, $collaborators);
    }

    /**
     * Returns the base URL for authorizing a client.
     *
     * Eg. https://oauth.service.com/authorize
     */
    public function getBaseAuthorizationUrl(): string
    {
        return $this->oAuthHost . '/api-v2/auth/authorize';
    }

    /**
     * Returns the base URL for requesting an access token.
     *
     * Eg. https://oauth.service.com/token
     */
    public function getBaseAccessTokenUrl(array $params): string
    {
        return $this->oAuthHost . '/api-v2/auth/token';
    }

    /**
     * Returns the URL for requesting the resource owner's details.
     */
    public function getResourceOwnerDetailsUrl(AccessToken $token): string
    {
        throw new \BadMethodCallException('Method not implemented.');
    }

    /**
     * Returns the default scopes used by this provider.
     *
     * This should only be the scopes that are required to request the details
     * of the resource owner, rather than all the available scopes.
     */
    protected function getDefaultScopes(): array
    {
        return [];
    }

    /**
     * Checks a provider response for errors.
     *
     * @param array|string $data Parsed response data
     *
     * @throws IdentityProviderException If parsed response data contains an error.
     */
    protected function checkResponse(ResponseInterface $response, $data): void
    {
        $message = $this->getErrorMessage($data);

        if (!empty($message)) {
            throw new IdentityProviderException(
                $message,
                $response->getStatusCode(),
                $response->getBody()->getContents()
            );
        }
    }

    /**
     * Returns error message if any, otherwise null.
     */
    private function getErrorMessage(array|string $parsedResponse): ?string
    {
        if (!is_array($parsedResponse) || !$this->responseHasError($parsedResponse)) {
            return null;
        }

        return !empty($parsedResponse['exception'])
            ? $parsedResponse['exception']
            : $parsedResponse['error_description'];
    }

    /**
     * Returns true if response has any error.
     */
    private function responseHasError(array $parsedResponse): bool
    {
        return !empty($parsedResponse['exception'])
                || !empty($parsedResponse['error_description'])
        ;
    }

    /**
     * Generates a resource owner object from a successful resource owner
     * details request.
     */
    protected function createResourceOwner(array $response, AccessToken $token): CctResourceOwner
    {
        return new CctResourceOwner();
    }

    protected function getDefaultHeaders()
    {
        return [
            // 'Content-Type' => 'application/json'
        ];
    }

    /**
     * Returns all headers used by this provider for a request.
     *
     * The request will be authenticated if an access token is provided.
     *
     * @param mixed|null $token object or string
     */
    public function getHeaders($token = null): array
    {
        if ($token) {
            return array_merge(
                $this->getDefaultHeaders(),
                $this->getAuthorizationHeaders($token)
            );
        }

        return $this->getDefaultHeaders();
    }
}
