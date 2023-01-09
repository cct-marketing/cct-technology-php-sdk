<?php

namespace CCT\SDK\Tests\Unit\Campaign\Data\Targeting\LocationTargeting;

use CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Address;
use CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Coordinate;
use CCT\SDK\Campaign\Data\Targeting\LocationTargeting\IndustryAddress;
use CCT\SDK\Campaign\Data\Targeting\LocationTargeting\LocationType;
use PHPUnit\Framework\TestCase;

class IndustryAddressTest extends TestCase
{
    public function testFromArray(): void
    {
        $data = IndustryAddressData::dataWithOverride();

        $industryAddress = IndustryAddress::fromArray($data);

        $this->assertInstanceOf(IndustryAddress::class, $industryAddress);
        $this->assertInstanceOf(Address::class, $industryAddress->address);
        $this->assertInstanceOf(LocationType::class, $industryAddress->type);
        $this->assertInstanceOf(Coordinate::class, $industryAddress->coordinate);
        $this->assertSame($data['type'], $industryAddress->type->value);
    }

    public function testToArray(): void
    {
        $data = IndustryAddressData::dataWithOverride();

        $industryAddress = IndustryAddress::fromArray($data);

        $this->assertSame($data, $industryAddress->toArray());
    }
}
