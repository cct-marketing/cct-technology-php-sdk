<?php

namespace CCT\SDK\Tests\Unit\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart;

use CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\Description;
use CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\DescriptionCollection;
use CCT\SDK\Infrastucture\Assert\Exception\AssertionFailedException;
use PHPUnit\Framework\TestCase;

class DescriptionCollectionTest extends TestCase
{
    public function testFromArray(): void
    {
        $data = ['Some description', 'Another description'];

        $descriptionCollection = DescriptionCollection::fromArray($data);

        $this->assertInstanceOf(DescriptionCollection::class, $descriptionCollection);
        $this->assertEquals(2, $descriptionCollection->count());
        $this->assertContainsOnlyInstancesOf(Description::class, $descriptionCollection->items());
    }

    public function testToArray(): void
    {
        $description1 = new Description('Some description');
        $description2 = new Description('Another description');
        $descriptionCollection = new DescriptionCollection([$description1, $description2]);

        $expected = ['Some description', 'Another description'];

        $this->assertEquals($expected, $descriptionCollection->toArray());
    }

    public function testTooFew(): void
    {
        $this->expectException(AssertionFailedException::class);
        DescriptionCollection::fromArray([]);
    }

    public function testTooMany(): void
    {
        $this->expectException(AssertionFailedException::class);
        DescriptionCollection::fromArray(['a', 'b', 'c', 'd', 'e', 'f']);
    }

    public function testDuplicates(): void
    {
        $this->expectException(AssertionFailedException::class);
        DescriptionCollection::fromArray(['a', 'a']);
    }
}
