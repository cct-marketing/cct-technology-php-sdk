<?php

declare(strict_types=1);

namespace CCT\SDK\Infrastucture\ValueObject;

abstract class AbstractUrlOption extends AbstractUrl
{
    protected const HOST_URL = '';

    public static function createDefault(): static
    {
        if (static::HOST_URL === '') {
            throw new \RuntimeException('Please declare the HOST_URL const in child class');
        }

        return new static(static::HOST_URL);
    }

    public static function createCustom(string $host): static
    {
        return new static($host);
    }

    public function withPath(string $path): static
    {
        $host = rtrim($this->toString(), '/');

        return new static(sprintf('%s/%s', $host, ltrim($path, '/')));
    }
}
