<?php

namespace CCT\SDK\Tests\Unit\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart;

use CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\Text;
use CCT\SDK\Infrastucture\Assert\Exception\AssertionFailedException;
use PHPUnit\Framework\TestCase;

class TextTest extends TestCase
{
    public function testConstruct(): void
    {
        $text = new Text('Some text');
        $this->assertEquals('Some text', $text->toString());
    }

    public function testTooLong(): void
    {
        $this->expectException(AssertionFailedException::class);
        new Text(str_repeat('a', 201));
    }

    public function testBlank(): void
    {
        $text = new Text('   ');
        $this->assertFalse($text->notBlank());
    }

    public function testNotBlank(): void
    {
        $text = new Text(' Some text ');
        $this->assertTrue($text->notBlank());
    }
}
