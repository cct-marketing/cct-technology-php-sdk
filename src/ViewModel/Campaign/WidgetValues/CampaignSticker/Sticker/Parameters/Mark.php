<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignSticker\Sticker\Parameters;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class Mark extends AbstractValueObject
{
    /**
     * @var string
     */
    private $value;

    /**
     * @return static
     *
     * @throws AssertionFailedException
     */
    public static function fromString(string $value): self
    {
        return new self($value);
    }

    /**
     * Mark constructor.
     *
     * @throws AssertionFailedException
     */
    private function __construct(string $value)
    {
        $this->guard($value);
        $this->value = $value;
    }

    /**
     * @throws AssertionFailedException
     */
    private function guard(string $value): void
    {
        Assertion::string($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function toString(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $this->value === $valueObject->value();
    }
}
