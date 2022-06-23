<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\Targeting\PropertyInformation;

use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class PropertyInformation extends AbstractValueObject
{
    /**
     * @var PropertyPrice|null
     */
    private $propertyPrice;

    /**
     * @var PropertySize|null
     */
    private $propertySize;

    /**
     * @var NumberOfBedrooms|null
     */
    private $numberOfBedrooms;

    public static function fromArray(array $data): self
    {
        return new self(
            isset($data['property_price']) ? PropertyPrice::fromInt($data['property_price']) : null,
            isset($data['property_size']) ? PropertySize::fromInt($data['property_size']) : null,
            isset($data['number_of_bedrooms']) ? NumberOfBedrooms::fromInt($data['number_of_bedrooms']) : null
        );
    }

    /**
     * PropertyInformation constructor.
     */
    private function __construct(
        ?PropertyPrice $propertyPrice,
        ?PropertySize $propertySize,
        ?NumberOfBedrooms $numberOfBedrooms
    ) {
        $this->propertyPrice = $propertyPrice;
        $this->propertySize = $propertySize;
        $this->numberOfBedrooms = $numberOfBedrooms;
    }

    public function toArray(): array
    {
        return [
            'property_price' => $this->propertyPrice ? $this->propertyPrice->toInt() : null,
            'property_size' => $this->propertySize ? $this->propertySize->toInt() : null,
            'number_of_bedrooms' => $this->numberOfBedrooms ? $this->numberOfBedrooms->toInt() : null,
        ];
    }

    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $this->toArray() === $valueObject->toArray();
    }

    public function __toString(): string
    {
        return (string) json_encode($this->toArray());
    }

    public function propertyPrice(): ?PropertyPrice
    {
        return $this->propertyPrice;
    }

    public function propertySize(): ?PropertySize
    {
        return $this->propertySize;
    }

    public function numberOfBedrooms(): ?NumberOfBedrooms
    {
        return $this->numberOfBedrooms;
    }
}
