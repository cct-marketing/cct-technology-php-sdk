<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook;

use CCT\SDK\Infrastucture\ValueObject\AbstractCollection;

final class FacebookAiMultiAdVariants extends AbstractCollection
{
    /**
     * @param FacebookAiMultiAdVariant[] $items
     */
    public function __construct(array $items)
    {
        parent::__construct($items);
    }

    public static function itemClassName(): string
    {
        return FacebookAiMultiAdVariant::class;
    }
}
