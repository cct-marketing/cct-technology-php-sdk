<?php

declare(strict_types=1);

namespace CCT\SDK\Infrastructure\ValueObject;

use CCT\SDK\Infrastructure\Serialization\Caster\CastListToSingleValueObject;

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
