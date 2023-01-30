<?php

declare(strict_types=1);

namespace CCT\SDK\Infrastructure\ValueObject;

interface SingleValueInterface
{
    public function toNative(): mixed;
}
