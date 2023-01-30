<?php

namespace CCT\SDK\Tests\Unit\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart;

use CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\Text;
use CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\TextCollection;
use CCT\SDK\Infrastructure\Assert\Exception\AssertionFailedException;
use PHPUnit\Framework\TestCase;

class TextCollectionTest extends TestCase
{
    public function testFromArray(): void
    {
        $data = ['Some text', 'Another text'];

        $textCollection = TextCollection::fromArray($data);

        $this->assertInstanceOf(TextCollection::class, $textCollection);
        $this->assertEquals(2, $textCollection->count());
        $this->assertContainsOnlyInstancesOf(Text::class, $textCollection->items());
    }

    public function testToArray(): void
    {
        $text1 = new Text('Some text');
        $text2 = new Text('Another text');
        $textCollection = new TextCollection([$text1, $text2]);

        $expected = ['Some text', 'Another text'];

        $this->assertEquals($expected, $textCollection->toArray());
    }

    public function testTooFew(): void
    {
        $this->expectException(AssertionFailedException::class);
        TextCollection::fromArray([]);
    }

    public function testTooMany(): void
    {
        $this->expectException(AssertionFailedException::class);
        TextCollection::fromArray(['a', 'b', 'c', 'd', 'e', 'f']);
    }

    public function testDuplicates(): void
    {
        $this->expectException(AssertionFailedException::class);
        TextCollection::fromArray(['a', 'a']);
    }
}
