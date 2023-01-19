<?php

declare(strict_types=1);

namespace CCT\SDK\Infrastucture\ValueObject;

interface SingleValueInterface
{
    public function toNative(): mixed;
}
