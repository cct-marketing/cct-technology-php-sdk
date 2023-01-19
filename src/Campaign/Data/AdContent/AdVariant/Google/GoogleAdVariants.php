<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\AdVariant\Google;

use CCT\SDK\Infrastucture\ValueObject\AbstractCollection;

final class GoogleAdVariants extends AbstractCollection
{
    /**
     * @param GoogleAdVariant[] $items
     */
    public function __construct(array $items)
    {
        parent::__construct($items);
    }

    public static function itemClassName(): string
    {
        return GoogleAdVariant::class;
    }
}
