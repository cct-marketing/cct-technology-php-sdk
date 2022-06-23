<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\LocationTargeting;

use Assert\Assertion;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class LocationType extends AbstractValueObject
{
    public const TYPE_DEFAULT = 'default';
    public const TYPE_REAL_ESTATE = 'real_estate';
    public const TYPE_AUTOMOTIVE = 'automotive';

    /**
     * @var string
     */
    private $type;

    /**
     * State constructor.
     */
    public function __construct(string $type)
    {
        $this->guard($type);
        $this->type = $type;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    private function guard($type): void
    {
        Assertion::inArray(
            $type,
            [self::TYPE_DEFAULT, self::TYPE_REAL_ESTATE, self::TYPE_AUTOMOTIVE],
            null,
            'location_type'
        );
    }

    /**
     * @param ValueObjectInterface|LocationType $type
     */
    public function equals(ValueObjectInterface $type): bool
    {
        if (!$type instanceof self) {
            return false;
        }

        return $this->type === $type->getType();
    }

    /**
     * @return LocationType
     */
    public static function defaultType(): self
    {
        return new static(self::TYPE_DEFAULT);
    }

    /**
     * @return LocationType
     */
    public static function realEstate(): self
    {
        return new static(self::TYPE_REAL_ESTATE);
    }

    /**
     * @return LocationType
     */
    public static function automotive(): self
    {
        return new static(self::TYPE_AUTOMOTIVE);
    }

    public function isDefault(): bool
    {
        return $this->equals(static::defaultType());
    }

    public function isRealEstate(): bool
    {
        return $this->equals(static::realEstate());
    }

    public function isAutomotive(): bool
    {
        return $this->equals(static::automotive());
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->type;
    }

    public function toString(): string
    {
        return $this->type;
    }

    public static function fromString(string $string): self
    {
        return new self($string);
    }
}