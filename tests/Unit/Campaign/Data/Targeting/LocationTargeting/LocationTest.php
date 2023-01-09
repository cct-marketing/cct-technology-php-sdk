<?php

namespace CCT\SDK\Tests\Unit\Campaign\Data\Targeting\LocationTargeting;

use CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Coordinate;
use CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Location;
use CCT\SDK\Campaign\Data\Targeting\LocationTargeting\LocationType;
use CCT\SDK\Campaign\Data\Targeting\LocationTargeting\Radius;
use PHPUnit\Framework\TestCase;

class LocationTest extends TestCase
{
    public function testFromArray()
    {
        $data = LocationData::dataWithOverride();

        $location = Location::fromArray($data);

        $this->assertEquals('123 Main St', $location->address);
        $this->assertInstanceOf(Coordinate::class, $location->coordinate);
        $this->assertEquals(37.4224764, $location->coordinate->latitude);
        $this->assertEquals(-122.0842499, $location->coordinate->longitude);
        $this->assertInstanceOf(Radius::class, $location->radius);
        $this->assertEquals(5, $location->radius->radius);
        $this->assertEquals('km', $location->radius->measurementUnit->value);
        $this->assertInstanceOf(LocationType::class, $location->type);
        $this->assertEquals('real_estate', $location->type->value);
    }

    public function testToArray(): void
    {
        $data = LocationData::dataWithOverride();

        $adContent = Location::fromArray($data);

        $this->assertSame($data, $adContent->toArray());
    }
}
