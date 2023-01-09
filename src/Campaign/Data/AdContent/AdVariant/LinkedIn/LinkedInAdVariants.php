<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\AdVariant\LinkedIn;

use CCT\SDK\Infrastucture\ValueObject\AbstractCollection;

final class LinkedInAdVariants extends AbstractCollection
{
    protected static function itemClassName(): string
    {
        return LinkedInAdVariant::class;
    }
}
