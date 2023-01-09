<?php

namespace CCT\SDK\Tests\Unit\Campaign\Data\Targeting\PropertyInformation;

use CCT\SDK\Campaign\Data\Targeting\PropertyInformation\NumberOfBedrooms;
use CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertyInformation;
use CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertyPrice;
use CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertySize;
use PHPUnit\Framework\TestCase;

class PropertyInformationTest extends TestCase
{
    public function testFromArray(): void
    {
        $data = PropertyInformationData::dataWithOverride();

        $propertyInformation = PropertyInformation::fromArray($data);

        $this->assertInstanceOf(PropertyPrice::class, $propertyInformation->propertyPrice);
        $this->assertInstanceOf(PropertySize::class, $propertyInformation->propertySize);
        $this->assertInstanceOf(NumberOfBedrooms::class, $propertyInformation->numberOfBedrooms);
        $this->assertEquals(123456, $propertyInformation->propertyPrice->toInt());
        $this->assertEquals(7890, $propertyInformation->propertySize->toInt());
        $this->assertEquals(3, $propertyInformation->numberOfBedrooms->toInt());
    }

    public function testToArray(): void
    {
        $data = PropertyInformationData::dataWithOverride();

        $adContent = PropertyInformation::fromArray($data);

        $this->assertSame($data, $adContent->toArray());
    }
}
