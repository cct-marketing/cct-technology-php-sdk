<?php

namespace CCT\SDK\Tests\Unit\Campaign\Data\AdContent\AdVariant\LinkedIn;

use CCT\SDK\Campaign\Data\AdContent\AdVariant\LinkedIn\LinkedInAdVariant;
use CCT\SDK\Campaign\Data\AdContent\Image\ImageCollection;
use CCT\SDK\Infrastructure\Assert\Exception\AssertionFailedException;
use PHPUnit\Framework\TestCase;

class LinkedInAdVariantTest extends TestCase
{
    public function testFromArray(): void
    {
        $data = LinkedInAdData::dataWithOverride();

        $variant = LinkedInAdVariant::fromArray($data);

        $this->assertInstanceOf(ImageCollection::class, $variant->images);
        $this->assertSame($data['text'], $variant->text);
    }

    public function testToArray(): void
    {
        $data = LinkedInAdData::dataWithOverride();

        $variant = LinkedInAdVariant::fromArray($data);

        $this->assertSame($data, $variant->toArray());
    }

    public function testGuard(): void
    {
        $this->expectException(AssertionFailedException::class);

        new LinkedInAdVariant(str_repeat('a', 201), null);
    }
}
