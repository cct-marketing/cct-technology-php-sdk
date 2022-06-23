<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\AdVariant\Google\ResponsiveAd;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class ShortHeadline extends AbstractValueObject
{
    /**
     * @var string
     */
    private $headline;

    /**
     * @throws AssertionFailedException
     */
    public static function fromString(string $headline): self
    {
        return new self($headline);
    }

    /**
     * ShortHeadline constructor.
     *
     * @throws AssertionFailedException
     */
    private function __construct(string $headline)
    {
        $this->guard($headline);
        $this->headline = $headline;
    }

    public function headline(): string
    {
        return $this->headline;
    }

    public function toString(): string
    {
        return $this->headline;
    }

    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $this->headline === $valueObject->headline();
    }

    public function __toString(): string
    {
        return $this->headline;
    }

    /**
     * @throws AssertionFailedException
     */
    private function guard(string $headline): void
    {
        Assertion::maxLength($headline, 30, null, self::errorPropertyPath());
    }

    public function notBlank(): bool
    {
        return trim($this->headline) !== '';
    }
}
