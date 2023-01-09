<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\AdVariant\Twitter;

use CCT\SDK\Infrastucture\ValueObject\AbstractCollection;

final class TwitterAdVariants extends AbstractCollection
{
    protected static function itemClassName(): string
    {
        return TwitterAdVariant::class;
    }
}
