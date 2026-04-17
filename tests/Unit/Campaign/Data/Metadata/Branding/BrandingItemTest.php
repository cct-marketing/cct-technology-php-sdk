<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Unit\Campaign\Data\Metadata\Branding;

use CCT\SDK\Campaign\Data\Metadata\Branding\BrandingItem;
use CCT\SDK\Campaign\Data\Metadata\Branding\BrandingKey;
use PHPUnit\Framework\TestCase;

final class BrandingItemTest extends TestCase
{
    public function testFromArray(): void
    {
        $data = BrandingItemData::dataWithOverride();

        $item = BrandingItem::fromArray($data);

        $this->assertInstanceOf(BrandingKey::class, $item->key);
        $this->assertSame('brand_colour', $item->key->toString());
        $this->assertEquals('#FF0000', $item->value);
    }

    public function testFromArrayWithLogoUrl(): void
    {
        $data = BrandingItemData::dataWithOverride([
            'key' => 'logo_url',
            'value' => 'https://example.com/logo.png',
        ]);

        $item = BrandingItem::fromArray($data);

        $this->assertSame('logo_url', $item->key->toString());
        $this->assertEquals('https://example.com/logo.png', $item->value);
    }

    public function testToArray(): void
    {
        $item = new BrandingItem(BrandingKey::fromString('text_colour'), '#000000');

        $expected = [
            'key' => 'text_colour',
            'value' => '#000000',
        ];

        $this->assertEquals($expected, $item->toArray());
    }

    public function testEquals(): void
    {
        $item1 = new BrandingItem(BrandingKey::fromString('brand_colour'), '#FF0000');
        $item2 = new BrandingItem(BrandingKey::fromString('brand_colour'), '#FF0000');
        $item3 = new BrandingItem(BrandingKey::fromString('brand_colour'), '#00FF00');
        $item4 = new BrandingItem(BrandingKey::fromString('text_colour'), '#FF0000');

        $this->assertTrue($item1->equals($item2));
        $this->assertFalse($item1->equals($item3));
        $this->assertFalse($item1->equals($item4));
    }
}
