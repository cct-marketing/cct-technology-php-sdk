<?php

namespace CCT\SDK\Tests\Unit\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart;

use CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\Heading;
use CCT\SDK\Infrastucture\Assert\Exception\AssertionFailedException;
use PHPUnit\Framework\TestCase;

class HeadingTest extends TestCase
{
    public function testConstruct(): void
    {
        $heading = new Heading('Some heading');
        $this->assertEquals('Some heading', $heading->toString());
    }

    public function testTooLong(): void
    {
        $this->expectException(AssertionFailedException::class);
        new Heading(str_repeat('a', 51));
    }

    public function testBlank(): void
    {
        $heading = new Heading('   ');
        $this->assertFalse($heading->notBlank());
    }

    public function testNotBlank(): void
    {
        $heading = new Heading(' Some heading ');
        $this->assertTrue($heading->notBlank());
    }
}
