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
     * @param string $value
     *
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
     * @param string $value
     *
     * @throws AssertionFailedException
     */
    private function __construct(string $value)
    {
        $this->guard($value);
        $this->value = $value;
    }

    /**
     * @param string $value
     *
     * @throws AssertionFailedException
     */
    private function guard(string $value): void
    {
        Assertion::string($value);
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toString();
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
