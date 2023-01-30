<?php

namespace CCT\SDK\Tests\Unit\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd;

use CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\Description;
use CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\DescriptionCollection;
use CCT\SDK\Infrastructure\Assert\Exception\AssertionFailedException;
use PHPUnit\Framework\TestCase;

final class DescriptionCollectionTest extends TestCase
{
    public function testFromArray(): void
    {
        $collection = DescriptionCollection::fromArray(['foo', 'bar']);

        $this->assertContainsOnlyInstancesOf(Description::class, $collection->items());
    }

    public function testToArray(): void
    {
        $collection = DescriptionCollection::fromArray(['foo', 'bar']);

        $this->assertEquals(['foo', 'bar'], $collection->toArray());
    }

    public function testNoDuplicates(): void
    {
        $this->expectException(AssertionFailedException::class);

        DescriptionCollection::fromArray(['foo', 'bar', 'bar']);
    }

    public function testAtLeastOne(): void
    {
        $this->expectException(AssertionFailedException::class);

        DescriptionCollection::fromArray([]);
    }

    public function testAtMostFive(): void
    {
        $this->expectException(AssertionFailedException::class);

        DescriptionCollection::fromArray(['1', '2', '3', '4', '5', '6']);
    }
}
