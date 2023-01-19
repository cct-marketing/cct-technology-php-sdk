<?php

declare(strict_types=1);

namespace CCT\SDK\Customer\Response;

use CCT\SDK\Customer\Response\List\Agency;
use CCT\SDK\Infrastucture\ValueObject\AbstractCollection;

final class ListResult extends AbstractCollection
{
    /**
     * @param Agency[] $items
     */
    public function __construct(array $items)
    {
        parent::__construct($items);
    }

    public static function itemClassName(): string
    {
        return Agency::class;
    }
}
