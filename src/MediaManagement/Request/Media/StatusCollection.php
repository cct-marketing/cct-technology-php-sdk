<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\Request\Media;

use CCT\SDK\Infrastucture\ValueObject\AbstractCollection;
use CCT\SDK\MediaManagement\ViewModel\Status;

final class StatusCollection extends AbstractCollection
{
    /**
     * @param Status[] $items
     */
    public function __construct(array $items)
    {
        parent::__construct($items);
    }

    public static function itemClassName(): string
    {
        return Status::class;
    }
}
