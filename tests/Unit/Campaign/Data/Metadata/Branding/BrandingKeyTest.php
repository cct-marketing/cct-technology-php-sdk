<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Unit\Campaign\Data\Metadata\Branding;

use CCT\SDK\Campaign\Data\Metadata\Branding\BrandingKey;
use CCT\SDK\Infrastructure\Assert\Exception\AssertionFailedException;
use PHPUnit\Framework\TestCase;

final class BrandingKeyTest extends TestCase
{
    /**
     * @dataProvider validKeys
     */
    public function testAcceptsValidSnakeCaseKeys(string $value): void
    {
        $key = BrandingKey::fromString($value);

        $this->assertSame($value, $key->toString());
        $this->assertSame($value, (string) $key);
    }

    public static function validKeys(): array
    {
        return [
            ['brand_colour'],
            ['text_colour'],
            ['logo_url'],
            ['primary'],
            ['accent_colour_2'],
        ];
    }

    /**
     * @dataProvider invalidKeys
     */
    public function testRejectsInvalidKeys(string $value): void
    {
        $this->expectException(\Throwable::class);

        BrandingKey::fromString($value);
    }

    public static function invalidKeys(): array
    {
        return [
            'empty' => [''],
            'uppercase' => ['BrandColour'],
            'camelCase' => ['brandColour'],
            'spaces' => ['brand colour'],
            'leading underscore' => ['_brand'],
            'trailing underscore' => ['brand_'],
            'double underscore' => ['brand__colour'],
            'leading digit' => ['1_brand'],
            'hyphen' => ['brand-colour'],
        ];
    }

    public function testEmptyValueThrowsAssertionFailure(): void
    {
        $this->expectException(AssertionFailedException::class);

        BrandingKey::fromString('');
    }

    public function testEquals(): void
    {
        $key1 = BrandingKey::fromString('brand_colour');
        $key2 = BrandingKey::fromString('brand_colour');
        $key3 = BrandingKey::fromString('text_colour');

        $this->assertTrue($key1->equals($key2));
        $this->assertFalse($key1->equals($key3));
    }
}
