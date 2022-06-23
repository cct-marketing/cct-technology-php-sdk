<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\Targeting\PropertyInformation;

use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class NumberOfBedrooms extends AbstractValueObject
{
    /**
     * @var int
     */
    private $bedrooms;

    public static function fromInt(int $bedrooms): self
    {
        return new self($bedrooms);
    }

    /**
     * NumberOfBedrooms constructor.
     */
    public function __construct(int $bedrooms)
    {
        $this->bedrooms = $bedrooms;
    }

    public function toInt(): int
    {
        return $this->bedrooms;
    }

    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $this->bedrooms === $valueObject->bedrooms;
    }

    public function __toString(): string
    {
        return (string) $this->bedrooms;
    }
}
