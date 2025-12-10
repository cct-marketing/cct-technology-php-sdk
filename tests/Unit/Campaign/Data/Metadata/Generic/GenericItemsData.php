<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Unit\Campaign\Data\Metadata\Generic;

use CCT\SDK\Campaign\Data\Metadata\Generic\GenericItems;

final class GenericItemsData
{
    public static function dataWithOverride(array $data = []): array
    {
        if (empty($data)) {
            return [
                ['key' => 'budget', 'value' => '50000'],
                ['key' => 'additional_spending', 'value' => '10000'],
            ];
        }

        return $data;
    }

    public static function createObject(array $data = []): GenericItems
    {
        return GenericItems::fromArray(self::dataWithOverride($data));
    }
}
