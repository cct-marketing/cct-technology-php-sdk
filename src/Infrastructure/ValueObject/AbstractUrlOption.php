<?php

declare(strict_types=1);

namespace CCT\SDK\Infrastructure\ValueObject;

use CCT\SDK\Client\Options\Mode;

abstract class AbstractUrlOption extends AbstractUrl
{
    protected const HOST_URL = '';
    protected const SANDBOX_HOST_URL = '';

    public static function createDefault(Mode $mode): static
    {
        if (static::HOST_URL === '') {
            throw new \RuntimeException('Please declare the HOST_URL const in child class');
        }
        if (static::SANDBOX_HOST_URL === '') {
            throw new \RuntimeException('Please declare the STAGING_HOST_URL const in child class');
        }

        return new static($mode->isLive() ? static::HOST_URL : static::SANDBOX_HOST_URL);
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
