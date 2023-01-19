<?php

declare(strict_types=1);

namespace CCT\SDK\Infrastucture\ValueObject;

use CCT\SDK\Infrastucture\Serialization\Caster\CastListToSingleValueObject;

trait CollectionWithSingleVOTrait
{
    public function __construct(
        #[CastListToSingleValueObject(self::class)]
        protected array $items
    ) {
        parent::__construct($items);
    }

    #[CastListToSingleValueObject(self::class)]
    public function items(): array
    {
        return $this->items;
    }
}
