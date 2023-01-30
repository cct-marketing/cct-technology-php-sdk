<?php

declare(strict_types=1);

namespace CCT\SDK\Infrastructure\ValueObject;

use CCT\SDK\Infrastructure\Assert\Assertion;

abstract class AbstractUrl extends AbstractString
{
    protected function guard(string $value): void
    {
        Assertion::url($value, static::errorPropertyPath());
        Assertion::maxLength($value, 2048, static::errorPropertyPath());
    }

    public function host(): string
    {
        return parse_url($this->value, PHP_URL_HOST);
    }

    public function scheme(): string
    {
        return parse_url($this->value, PHP_URL_SCHEME);
    }

    public function port(): ?int
    {
        return parse_url($this->value, PHP_URL_PORT);
    }
}
