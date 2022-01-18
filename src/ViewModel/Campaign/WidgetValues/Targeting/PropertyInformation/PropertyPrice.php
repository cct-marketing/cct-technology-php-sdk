<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\Targeting\PropertyInformation;

use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class PropertyPrice extends AbstractValueObject
{
    /**
     * @var int
     */
    private $amount;

    public static function fromInt(int $amount): self
    {
        return new self($amount);
    }

    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }

    public function toInt(): int
    {
        return $this->amount;
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
        return (string) $this->amount;
    }

    public function amount(): int
    {
        return $this->amount;
    }
}
