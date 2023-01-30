<?php

namespace CCT\SDK\Tests\Unit\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart;

use CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\Heading;
use CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\HeadingCollection;
use CCT\SDK\Infrastructure\Assert\Exception\AssertionFailedException;
use PHPUnit\Framework\TestCase;

class HeadingCollectionTest extends TestCase
{
    public function testFromArray(): void
    {
        $data = ['Some heading', 'Another heading'];

        $headingCollection = HeadingCollection::fromArray($data);

        $this->assertInstanceOf(HeadingCollection::class, $headingCollection);
        $this->assertEquals(2, $headingCollection->count());
        $this->assertContainsOnlyInstancesOf(Heading::class, $headingCollection->items());
    }

    public function testToArray(): void
    {
        $heading1 = new Heading('Some heading');
        $heading2 = new Heading('Another heading');
        $headingCollection = new HeadingCollection([$heading1, $heading2]);

        $expected = ['Some heading', 'Another heading'];

        $this->assertEquals($expected, $headingCollection->toArray());
    }

    public function testTooFew(): void
    {
        $this->expectException(AssertionFailedException::class);
        HeadingCollection::fromArray([]);
    }

    public function testTooMany(): void
    {
        $this->expectException(AssertionFailedException::class);
        HeadingCollection::fromArray(['a', 'b', 'c', 'd', 'e', 'f']);
    }

    public function testDuplicates(): void
    {
        $this->expectException(AssertionFailedException::class);
        HeadingCollection::fromArray(['a', 'a']);
    }
}
