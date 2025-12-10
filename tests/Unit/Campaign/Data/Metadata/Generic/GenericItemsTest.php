<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Unit\Campaign\Data\Metadata\Generic;

use CCT\SDK\Campaign\Data\Metadata\Generic\GenericItem;
use CCT\SDK\Campaign\Data\Metadata\Generic\GenericItems;
use CCT\SDK\Campaign\Data\Metadata\Generic\GenericKey;
use PHPUnit\Framework\TestCase;

final class GenericItemsTest extends TestCase
{
    public function testFromArray(): void
    {
        $data = GenericItemsData::dataWithOverride();

        $items = GenericItems::fromArray($data);

        $this->assertCount(2, $items);
        $this->assertInstanceOf(GenericItem::class, $items->first());
        $this->assertSame(GenericKey::BUDGET, $items->first()->key);
    }

    public function testToArray(): void
    {
        $item1 = new GenericItem(GenericKey::BUDGET, '50000');
        $item2 = new GenericItem(GenericKey::ADDITIONAL_SPENDING, '10000');

        $items = GenericItems::fromItems($item1, $item2);

        $expected = [
            ['key' => 'budget', 'value' => '50000'],
            ['key' => 'additional_spending', 'value' => '10000'],
        ];

        $this->assertEquals($expected, $items->toArray());
    }

    public function testEmptyList(): void
    {
        $items = GenericItems::emptyList();

        $this->assertCount(0, $items);
        $this->assertEquals([], $items->toArray());
    }

    public function testFromEmptyArray(): void
    {
        $items = GenericItems::fromArray([]);

        $this->assertCount(0, $items);
    }

    public function testPush(): void
    {
        $items = GenericItems::emptyList();
        $item = new GenericItem(GenericKey::BUDGET, '50000');

        $newItems = $items->push($item);

        $this->assertCount(0, $items);
        $this->assertCount(1, $newItems);
        $this->assertTrue($newItems->contains($item));
    }

    public function testContains(): void
    {
        $item1 = new GenericItem(GenericKey::BUDGET, '50000');
        $item2 = new GenericItem(GenericKey::ADDITIONAL_SPENDING, '10000');
        $item3 = new GenericItem(GenericKey::BUDGET, '60000');

        $items = GenericItems::fromItems($item1, $item2);

        $this->assertTrue($items->contains($item1));
        $this->assertTrue($items->contains($item2));
        $this->assertFalse($items->contains($item3));
    }

    public function testEquals(): void
    {
        $items1 = GenericItemsData::createObject();
        $items2 = GenericItemsData::createObject();
        $items3 = GenericItems::fromArray([
            ['key' => 'budget', 'value' => '99999'],
        ]);

        $this->assertTrue($items1->equals($items2));
        $this->assertFalse($items1->equals($items3));
    }

    public function testIterable(): void
    {
        $items = GenericItemsData::createObject();
        $count = 0;

        foreach ($items as $item) {
            $this->assertInstanceOf(GenericItem::class, $item);
            $count++;
        }

        $this->assertEquals(2, $count);
    }
}
