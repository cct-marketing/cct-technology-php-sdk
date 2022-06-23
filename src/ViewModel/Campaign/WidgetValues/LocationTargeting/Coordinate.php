<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\LocationTargeting;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class Coordinate extends AbstractValueObject
{
    /**
     * The latitude of the coordinate.
     *
     * @var float
     */
    protected $latitude;

    /**
     * The longitude of the coordinate.
     *
     * @var float
     */
    protected $longitude;

    /**
     * Coordinate constructor.
     */
    public function __construct(float $latitude, float $longitude)
    {
        $this->guard($latitude, $longitude);
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * @param ValueObjectInterface | Coordinate $valueObject
     */
    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $this->latitude === $valueObject->getLatitude()
            && $this->longitude === $valueObject->getLongitude();
    }

    /**
     * Serialize object into an array or string
     */
    public function toArray(): array
    {
        return [
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }

    /**
     * @throws AssertionFailedException
     */
    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'latitude', null, 'coordinate');
        Assertion::keyExists($data, 'longitude', null, 'coordinate');

        Assertion::numeric($data['latitude'], null, 'coordinate');
        Assertion::numeric($data['longitude'], null, 'coordinate');

        return new self(
            (float) $data['latitude'],
            (float) $data['longitude']
        );
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    private function guard(float $latitude, float $longitude)
    {
        Assertion::between($latitude, -90, 90, 'null', 'coordinate');
        Assertion::between($longitude, -180, 180, 'null', 'coordinate');
    }
}
