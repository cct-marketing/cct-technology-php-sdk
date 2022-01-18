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

    /**
     * @param array $data
     *
     * @return self
     */
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
     *
     * @param PropertyPrice|null    $propertyPrice
     * @param PropertySize|null     $propertySize
     * @param NumberOfBedrooms|null $numberOfBedrooms
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

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'property_price' => $this->propertyPrice ? $this->propertyPrice->toInt() : null,
            'property_size' => $this->propertySize ? $this->propertySize->toInt() : null,
            'number_of_bedrooms' => $this->numberOfBedrooms ? $this->numberOfBedrooms->toInt() : null,
        ];
    }

    /**
     * @param ValueObjectInterface $valueObject
     *
     * @return bool
     */
    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $this->toArray() === $valueObject->toArray();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) json_encode($this->toArray());
    }

    /**
     * @return PropertyPrice|null
     */
    public function propertyPrice(): ?PropertyPrice
    {
        return $this->propertyPrice;
    }

    /**
     * @return PropertySize|null
     */
    public function propertySize(): ?PropertySize
    {
        return $this->propertySize;
    }

    /**
     * @return NumberOfBedrooms|null
     */
    public function numberOfBedrooms(): ?NumberOfBedrooms
    {
        return $this->numberOfBedrooms;
    }
}
