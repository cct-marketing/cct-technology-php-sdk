<?php

declare(strict_types=1);

namespace CCT\SDK\Customer\Response;

use CCT\SDK\Customer\Response\List\Agency;
use CCT\SDK\Infrastucture\ValueObject\AbstractCollection;

final class ListResult extends AbstractCollection
{
    protected static function itemClassName(): string
    {
        return Agency::class;
    }
}
