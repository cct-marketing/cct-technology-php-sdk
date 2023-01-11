<?php

namespace CCT\SDK\Client\Options;

enum Mode: string
{
    case LIVE = 'live';
    case SANDBOX = 'sandbox';

    public function isLive(): bool
    {
        return $this === self::LIVE;
    }

    public function isSandbox(): bool
    {
        return $this === self::SANDBOX;
    }
}
