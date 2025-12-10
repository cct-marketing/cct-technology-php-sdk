<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Unit\Campaign\Data\Metadata\Generic;

use CCT\SDK\Campaign\Data\Metadata\Generic\GenericItem;

final class GenericItemData
{
    public static function dataWithOverride(array $data = []): array
    {
        return array_merge(
            [
                'key' => 'budget',
                'value' => '50000',
            ],
            $data
        );
    }

    public static function createObject(array $data = []): GenericItem
    {
        return GenericItem::fromArray(self::dataWithOverride($data));
    }
}
