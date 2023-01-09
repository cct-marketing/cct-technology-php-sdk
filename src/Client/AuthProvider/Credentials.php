<?php

declare(strict_types=1);

namespace CCT\SDK\Client\AuthProvider;

use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class Credentials extends AbstractMulti
{
    public function __construct(public readonly string $clientId, public readonly string $clientSecret)
    {
        $this->guard($clientId, $clientSecret);
    }

    public function toArray(): array
    {
        return [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ];
    }

    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'client_id', self::errorPropertyPath());
        Assertion::keyExists($data, 'client_secret', self::errorPropertyPath());

        return new self($data['client_id'], $data['client_secret']);
    }

    private function guard(string $clientId, string $clientSecret)
    {
        Assertion::notEmpty($clientId, self::errorPropertyPath());
        Assertion::notEmpty($clientSecret, self::errorPropertyPath());
    }
}
