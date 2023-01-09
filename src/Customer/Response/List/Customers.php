<?php

declare(strict_types=1);

namespace CCT\SDK\Customer\Response\List;

use CCT\SDK\Infrastucture\ValueObject\AbstractCollection;

final class Customers extends AbstractCollection
{
    protected static function itemClassName(): string
    {
        return Customer::class;
    }
}
