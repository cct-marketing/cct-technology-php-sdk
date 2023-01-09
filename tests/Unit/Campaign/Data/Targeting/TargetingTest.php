<?php

namespace CCT\SDK\Tests\Unit\Campaign\Data\Targeting;

use CCT\SDK\Campaign\Data\Targeting\LocationTargeting\IndustryAddress;
use CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Locations;
use CCT\SDK\Campaign\Data\Targeting\PropertyInformation\PropertyInformation;
use CCT\SDK\Campaign\Data\Targeting\Targeting;
use PHPUnit\Framework\TestCase;

class TargetingTest extends TestCase
{
    public function testFromArray(): void
    {
        $data = TargetingData::dataWithOverride();

        $targeting = Targeting::fromArray($data);

        $this->assertInstanceOf(Locations::class, $targeting->locations);
        $this->assertInstanceOf(IndustryAddress::class, $targeting->industryAddress);
        $this->assertInstanceOf(PropertyInformation::class, $targeting->propertyInformation);
    }

    public function testToArray(): void
    {
        $data = TargetingData::dataWithOverride();

        $adContent = Targeting::fromArray($data);

        $this->assertSame($data, $adContent->toArray());
    }
}
