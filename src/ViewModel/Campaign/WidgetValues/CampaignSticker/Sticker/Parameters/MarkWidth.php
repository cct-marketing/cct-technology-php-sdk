<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignSticker\Sticker\Parameters;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class MarkWidth extends AbstractValueObject
{
    /** @var float */
    private $value;

    /**
     * @param float $value
     *
     * @return static
     *
     * @throws AssertionFailedException
     */
    public static function fromFloat(float $value): self
    {
        return new self($value);
    }

    /**
     * MarkWidth constructor.
     *
     * @param float $value
     *
     * @throws AssertionFailedException
     */
    private function __construct(float $value)
    {
        $this->guard($value);
        $this->value = $value;
    }

    /**
     * @return float
     */
    public function value(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     *
     * @throws AssertionFailedException
     */
    private function guard(float $value): void
    {
        Assertion::greaterThan($value, 0);
        Assertion::max($value, 1);
    }

    /**
     * @return float
     */
    public function toFloat(): float
    {
        return $this->value();
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

        return $this->value === $valueObject->value();
    }
}
