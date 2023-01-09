<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\Video;

interface VideoInterface
{
    public function uuid(): string;

    public function toArray(): array;
}
