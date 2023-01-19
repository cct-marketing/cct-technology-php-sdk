<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\AdVariant\Twitter;

use CCT\SDK\Infrastucture\ValueObject\AbstractCollection;

final class TwitterAdVariants extends AbstractCollection
{
    /**
     * @param TwitterAdVariant[] $items
     */
    public function __construct(array $items)
    {
        parent::__construct($items);
    }

    public static function itemClassName(): string
    {
        return TwitterAdVariant::class;
    }
}
