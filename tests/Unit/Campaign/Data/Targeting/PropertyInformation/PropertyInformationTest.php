<?php

namespace CCT\SDK\Tests\Unit\Campaign\Data\Targeting\PropertyInformation;

use CCT\SDK\Campaign\Data\Targeting\PropertyInformation\NumberOfBedrooms;
use CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertyInformation;
use CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertyEnergyLabel;
use CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertyPrice;
use CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertySize;
use CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertyTotalPrice;
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
        $this->assertEquals('Property description used to help create ad content texts', $propertyInformation->propertyDescription->toString());
        $this->assertEquals('Property Type', $propertyInformation->propertyType->toString());
        $this->assertInstanceOf(PropertyTotalPrice::class, $propertyInformation->propertyTotalPrice);
        $this->assertEquals(654321, $propertyInformation->propertyTotalPrice->toInt());
        $this->assertInstanceOf(PropertyEnergyLabel::class, $propertyInformation->propertyEnergyLabel);
        $this->assertEquals('A+', $propertyInformation->propertyEnergyLabel->toString());
    }

    public function testWithEmptyArray(): void
    {
        $propertyInformation = PropertyInformation::fromArray([]);

        $this->assertNull($propertyInformation->propertyPrice);
        $this->assertNull($propertyInformation->propertySize);
        $this->assertNull($propertyInformation->numberOfBedrooms);
        $this->assertNull($propertyInformation->propertyDescription);
        $this->assertNull($propertyInformation->propertyType);
        $this->assertNull($propertyInformation->propertyTotalPrice);
        $this->assertNull($propertyInformation->propertyEnergyLabel);
    }

    public function testToArray(): void
    {
        $data = PropertyInformationData::dataWithOverride();

        $propertyInformation = PropertyInformation::fromArray($data);

        $this->assertSame($data, $propertyInformation->toArray());
    }
}
