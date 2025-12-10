<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Unit\Campaign\Data\Metadata\Generic;

use CCT\SDK\Campaign\Data\Metadata\Generic\GenericItem;
use CCT\SDK\Campaign\Data\Metadata\Generic\GenericKey;
use PHPUnit\Framework\TestCase;

final class GenericItemTest extends TestCase
{
    public function testFromArray(): void
    {
        $data = GenericItemData::dataWithOverride();

        $item = GenericItem::fromArray($data);

        $this->assertSame(GenericKey::BUDGET, $item->key);
        $this->assertEquals('50000', $item->value);
    }

    public function testFromArrayWithAdditionalSpending(): void
    {
        $data = GenericItemData::dataWithOverride([
            'key' => 'additional_spending',
            'value' => '10000',
        ]);

        $item = GenericItem::fromArray($data);

        $this->assertSame(GenericKey::ADDITIONAL_SPENDING, $item->key);
        $this->assertEquals('10000', $item->value);
    }

    public function testToArray(): void
    {
        $item = new GenericItem(GenericKey::BUDGET, '50000');

        $expected = [
            'key' => 'budget',
            'value' => '50000',
        ];

        $this->assertEquals($expected, $item->toArray());
    }

    public function testEquals(): void
    {
        $item1 = new GenericItem(GenericKey::BUDGET, '50000');
        $item2 = new GenericItem(GenericKey::BUDGET, '50000');
        $item3 = new GenericItem(GenericKey::BUDGET, '60000');
        $item4 = new GenericItem(GenericKey::ADDITIONAL_SPENDING, '50000');

        $this->assertTrue($item1->equals($item2));
        $this->assertFalse($item1->equals($item3));
        $this->assertFalse($item1->equals($item4));
    }
}
