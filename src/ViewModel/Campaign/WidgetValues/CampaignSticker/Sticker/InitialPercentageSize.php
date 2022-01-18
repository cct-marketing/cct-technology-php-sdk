<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignSticker\Sticker;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class InitialPercentageSize extends AbstractValueObject
{
    /** @var int */
    private $size;

    /**
     * @return static
     *
     * @throws AssertionFailedException
     */
    public static function fromDefaultInteger(): self
    {
        return new static(40);
    }

    /**
     * @param int $size
     *
     * @return static
     *
     * @throws AssertionFailedException
     */
    public static function fromInteger(int $size): self
    {
        return new static($size);
    }

    /**
     * InitialPercentageSize constructor.
     *
     * @param int $size
     *
     * @throws AssertionFailedException
     */
    private function __construct(int $size)
    {
        $this->guard($size);
        $this->size = $size;
    }

    /**
     * @return int
     */
    public function size(): int
    {
        return $this->size;
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

        return $this->size === $valueObject->size();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->size;
    }

    /**
     * @param int $size
     *
     * @throws AssertionFailedException
     */
    private function guard(int $size): void
    {
        Assertion::min($size, 10, null, self::errorPropertyPath());
        Assertion::max($size, 100, null, self::errorPropertyPath());
    }
}
