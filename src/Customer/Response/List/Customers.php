<?php

declare(strict_types=1);

namespace CCT\SDK\Customer\Response\List;

use CCT\SDK\Infrastucture\ValueObject\AbstractCollection;

final class Customers extends AbstractCollection
{
    /**
     * @param Customer[] $items
     */
    public function __construct(array $items)
    {
        parent::__construct($items);
    }

    public static function itemClassName(): string
    {
        return Customer::class;
    }
}
