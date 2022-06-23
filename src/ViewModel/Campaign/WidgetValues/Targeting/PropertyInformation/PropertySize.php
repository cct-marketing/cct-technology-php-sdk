<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\Targeting\PropertyInformation;

use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class PropertySize extends AbstractValueObject
{
    /**
     * @var int
     */
    private $size;

    public static function fromInt(int $size): self
    {
        return new self($size);
    }

    /**
     * Size constructor.
     */
    public function __construct(int $size)
    {
        $this->size = $size;
    }

    public function toInt(): int
    {
        return $this->size;
    }

    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $this->toInt() === $valueObject->toInt();
    }

    public function __toString(): string
    {
        return (string) $this->size;
    }
}
