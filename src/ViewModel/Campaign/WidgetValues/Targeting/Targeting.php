<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\Targeting;

use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\Targeting\PropertyInformation\PropertyInformation;

final class Targeting extends AbstractValueObject
{
    /**
     * @var PropertyInformation | null
     */
    private $propertyInformation;

    public static function fromArray(array $data): self
    {
        return new self(
            isset($data['property_information'])
                ? PropertyInformation::fromArray($data['property_information']) : null
        );
    }

    /**
     * CampaignDetails constructor.
     *
     * @param PropertyInformation $propertyInformation
     */
    private function __construct(?PropertyInformation $propertyInformation)
    {
        $this->propertyInformation = $propertyInformation;
    }

    public function toArray(): array
    {
        return [
            'property_information' => $this->propertyInformation ? $this->propertyInformation->toArray() : null,
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

    /**
     * @return PropertyInformation | null
     */
    public function propertyInformation(): ?PropertyInformation
    {
        return $this->propertyInformation;
    }
}
