<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Unit\Campaign\Data\Metadata\Branding;

use CCT\SDK\Campaign\Data\Metadata\Branding\BrandingItem;
use CCT\SDK\Campaign\Data\Metadata\Branding\BrandingItems;
use CCT\SDK\Campaign\Data\Metadata\Branding\BrandingKey;
use PHPUnit\Framework\TestCase;

final class BrandingItemsTest extends TestCase
{
    public function testFromArray(): void
    {
        $data = BrandingItemsData::dataWithOverride();

        $items = BrandingItems::fromArray($data);

        $this->assertCount(3, $items);
        $this->assertInstanceOf(BrandingItem::class, $items->first());
        $this->assertSame('brand_colour', $items->first()->key->toString());
    }

    public function testToArray(): void
    {
        $item1 = new BrandingItem(BrandingKey::fromString('brand_colour'), '#FF0000');
        $item2 = new BrandingItem(BrandingKey::fromString('text_colour'), '#000000');
        $item3 = new BrandingItem(BrandingKey::fromString('logo_url'), 'https://example.com/logo.png');

        $items = BrandingItems::fromItems($item1, $item2, $item3);

        $expected = [
            ['key' => 'brand_colour', 'value' => '#FF0000'],
            ['key' => 'text_colour', 'value' => '#000000'],
            ['key' => 'logo_url', 'value' => 'https://example.com/logo.png'],
        ];

        $this->assertEquals($expected, $items->toArray());
    }

    public function testEmptyList(): void
    {
        $items = BrandingItems::emptyList();

        $this->assertCount(0, $items);
        $this->assertEquals([], $items->toArray());
    }

    public function testFromEmptyArray(): void
    {
        $items = BrandingItems::fromArray([]);

        $this->assertCount(0, $items);
    }

    public function testPush(): void
    {
        $items = BrandingItems::emptyList();
        $item = new BrandingItem(BrandingKey::fromString('brand_colour'), '#FF0000');

        $newItems = $items->push($item);

        $this->assertCount(0, $items);
        $this->assertCount(1, $newItems);
        $this->assertTrue($newItems->contains($item));
    }

    public function testContains(): void
    {
        $item1 = new BrandingItem(BrandingKey::fromString('brand_colour'), '#FF0000');
        $item2 = new BrandingItem(BrandingKey::fromString('text_colour'), '#000000');
        $item3 = new BrandingItem(BrandingKey::fromString('brand_colour'), '#00FF00');

        $items = BrandingItems::fromItems($item1, $item2);

        $this->assertTrue($items->contains($item1));
        $this->assertTrue($items->contains($item2));
        $this->assertFalse($items->contains($item3));
    }

    public function testEquals(): void
    {
        $items1 = BrandingItemsData::createObject();
        $items2 = BrandingItemsData::createObject();
        $items3 = BrandingItems::fromArray([
            ['key' => 'brand_colour', 'value' => '#00FF00'],
        ]);

        $this->assertTrue($items1->equals($items2));
        $this->assertFalse($items1->equals($items3));
    }

    public function testIterable(): void
    {
        $items = BrandingItemsData::createObject();
        $count = 0;

        foreach ($items as $item) {
            $this->assertInstanceOf(BrandingItem::class, $item);
            $count++;
        }

        $this->assertEquals(3, $count);
    }
}
