<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Unit\Campaign\Data\Metadata\Generic;

use CCT\SDK\Campaign\Data\Metadata\Generic\GenericKey;
use PHPUnit\Framework\TestCase;

final class GenericKeyTest extends TestCase
{
    public function testEnumValues(): void
    {
        $this->assertEquals('budget', GenericKey::BUDGET->value);
        $this->assertEquals('additional_spending', GenericKey::ADDITIONAL_SPENDING->value);
    }

    public function testFromString(): void
    {
        $budget = GenericKey::from('budget');
        $additionalSpending = GenericKey::from('additional_spending');

        $this->assertSame(GenericKey::BUDGET, $budget);
        $this->assertSame(GenericKey::ADDITIONAL_SPENDING, $additionalSpending);
    }

    public function testTryFromWithInvalidValue(): void
    {
        $result = GenericKey::tryFrom('invalid_key');

        $this->assertNull($result);
    }

    public function testFromWithInvalidValueThrowsException(): void
    {
        $this->expectException(\ValueError::class);

        GenericKey::from('invalid_key');
    }

    public function testCases(): void
    {
        $cases = GenericKey::cases();

        $this->assertCount(2, $cases);
        $this->assertContains(GenericKey::BUDGET, $cases);
        $this->assertContains(GenericKey::ADDITIONAL_SPENDING, $cases);
    }
}
