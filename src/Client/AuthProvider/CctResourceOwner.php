<?php

declare(strict_types=1);

namespace CCT\SDK\Client\AuthProvider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

final class CctResourceOwner implements ResourceOwnerInterface
{
    /**
     * Returns the identifier of the authorized resource owner.
     */
    public function getId()
    {
        throw new \BadMethodCallException('Method not implemented yet.');
    }

    /**
     * Return all of the owner details available as an array.
     */
    public function toArray(): array
    {
        throw new \BadMethodCallException('Method not implemented yet.');
    }
}
