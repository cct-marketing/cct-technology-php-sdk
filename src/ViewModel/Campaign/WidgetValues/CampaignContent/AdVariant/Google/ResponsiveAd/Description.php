<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\AdVariant\Google\ResponsiveAd;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class Description extends AbstractValueObject
{
    /**
     * @var string
     */
    private $text;

    /**
     * @throws AssertionFailedException
     */
    public static function fromString(string $text): self
    {
        return new self($text);
    }

    /**
     * Description constructor.
     *
     * @throws AssertionFailedException
     */
    private function __construct(string $text)
    {
        $this->guard($text);
        $this->text = $text;
    }

    public function text(): string
    {
        return $this->text;
    }

    public function toString(): string
    {
        return $this->text;
    }

    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $this->text === $valueObject->text();
    }

    public function __toString(): string
    {
        return $this->text;
    }

    /**
     * @throws AssertionFailedException
     */
    private function guard(string $text): void
    {
        Assertion::maxLength($text, 90, null, self::errorPropertyPath());
    }

    public function notBlank(): bool
    {
        return trim($this->text) !== '';
    }
}
