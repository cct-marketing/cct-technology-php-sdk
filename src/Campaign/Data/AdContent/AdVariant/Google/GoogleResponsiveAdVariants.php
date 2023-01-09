<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\AdVariant\Google;

use CCT\SDK\Infrastucture\ValueObject\AbstractCollection;

final class GoogleResponsiveAdVariants extends AbstractCollection
{
    protected static function itemClassName(): string
    {
        return GoogleResponsiveAdVariant::class;
    }
}
