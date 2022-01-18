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

    /**
     * @param int $bedrooms
     *
     * @return self
     */
    public static function fromInt(int $bedrooms): self
    {
        return new self($bedrooms);
    }

    /**
     * NumberOfBedrooms constructor.
     *
     * @param int $bedrooms
     */
    public function __construct(int $bedrooms)
    {
        $this->bedrooms = $bedrooms;
    }

    /**
     * @return int
     */
    public function toInt(): int
    {
        return $this->bedrooms;
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

        return $this->bedrooms === $valueObject->bedrooms;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->bedrooms;
    }
}
