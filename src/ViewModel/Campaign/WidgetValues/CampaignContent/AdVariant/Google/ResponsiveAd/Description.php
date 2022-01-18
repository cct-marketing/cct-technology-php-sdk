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
     * @param string $text
     *
     * @return self
     *
     * @throws AssertionFailedException
     */
    public static function fromString(string $text): self
    {
        return new self($text);
    }

    /**
     * Description constructor.
     *
     * @param string $text
     *
     * @throws AssertionFailedException
     */
    private function __construct(string $text)
    {
        $this->guard($text);
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function text(): string
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->text;
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

        return $this->text === $valueObject->text();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     *
     * @throws AssertionFailedException
     */
    private function guard(string $text): void
    {
        Assertion::maxLength($text, 90, null, self::errorPropertyPath());
    }

    /**
     * @return bool
     */
    public function notBlank(): bool
    {
        return trim($this->text) !== '';
    }
}
