<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\LocationTargeting;

use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

/**
 * Location Targeting
 *
 * Collection of Location targets
 *
 * Notes from facebook:
 * The minimum and maximum radius varies by location type.
 *
 * We'll target all other locations of the type you selected that fall within the radius. For cities, this means
 * that if the city center falls within the radius, we'll target that city. If it doesn't, we won't.
 *
 * If you target a location near the border of a country, the radius will not extend into the other country. You'll
 * have to target the other country separately. This applies even though our visualized radius may extend beyond the
 * border.
 * You can't use radius targeting for ZIP or postal codes, states, regions or countries.
 * When you target specific countries, states, regions, ZIP or postal codes, you'll see a polygon shape around the area.
 * We won't show the polygon shape for a city when the entire city is selected, but in this instance, the entire city
 * will be targeted.
 */
final class LocationTargeting extends AbstractValueObject
{
    /**
     * @var Location[]
     */
    private $locations;

    public static function fromArray(array $locations): self
    {
        return new self(...array_map(static function (array $location) {
            return Location::fromArray($location);
        }, $locations));
    }

    /**
     * @param Location ...$locations
     */
    public static function fromItems(Location ...$locations): self
    {
        return new self(...$locations);
    }

    public static function emptyList(): self
    {
        return new self();
    }

    /**
     * Constructor.
     *
     * @param Location ...$locations
     */
    private function __construct(Location ...$locations)
    {
        $this->locations = $locations;
    }

    public function push(Location $location): self
    {
        $copy = clone $this;
        $copy->locations[] = $location;

        return $copy;
    }

    public function pop(): self
    {
        $copy = clone $this;
        array_pop($copy->locations);

        return $copy;
    }

    public function first(): ?Location
    {
        return $this->locations[0] ?? null;
    }

    public function last(): ?Location
    {
        if (count($this->locations) === 0) {
            return null;
        }

        return $this->locations[count($this->locations) - 1];
    }

    public function contains(Location $location): bool
    {
        foreach ($this->locations as $existingLocation) {
            if ($existingLocation->equals($location)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return Location[]
     */
    public function locations(): array
    {
        return $this->locations;
    }

    public function toArray(): array
    {
        return array_map(static function (Location $location) {
            return $location->toArray();
        }, $this->locations);
    }

    public function equals(ValueObjectInterface $other): bool
    {
        if (!$other instanceof self) {
            return false;
        }

        return $this->toArray() === $other->toArray();
    }

    public function __toString(): string
    {
        return (string) json_encode($this->toArray());
    }

    public function count(): int
    {
        return count($this->locations);
    }
}
