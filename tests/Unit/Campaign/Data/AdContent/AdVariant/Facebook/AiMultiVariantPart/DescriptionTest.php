<?php

namespace CCT\SDK\Tests\Unit\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart;

use CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\Description;
use CCT\SDK\Infrastructure\Assert\Exception\AssertionFailedException;
use PHPUnit\Framework\TestCase;

class DescriptionTest extends TestCase
{
    public function testConstruct(): void
    {
        $description = new Description('Some description');
        $this->assertEquals('Some description', $description->toString());
    }

    public function testTooLong(): void
    {
        $this->expectException(AssertionFailedException::class);
        new Description(str_repeat('a', 61));
    }

    public function testBlank(): void
    {
        $description = new Description('   ');
        $this->assertFalse($description->notBlank());
    }

    public function testNotBlank(): void
    {
        $description = new Description(' Some description ');
        $this->assertTrue($description->notBlank());
    }
}
