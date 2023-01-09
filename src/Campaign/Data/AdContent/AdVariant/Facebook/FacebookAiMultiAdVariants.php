<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook;

use CCT\SDK\Infrastucture\ValueObject\AbstractCollection;

final class FacebookAiMultiAdVariants extends AbstractCollection
{
    protected static function itemClassName(): string
    {
        return FacebookAiMultiAdVariant::class;
    }
}
