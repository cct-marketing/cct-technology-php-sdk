<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class CampaignTitle extends AbstractValueObject
{
    /**
     * @var string;
     */
    private $title;

    /**
     * CampaignTitle constructor.
     *
     * @param string $title
     *
     * @throws AssertionFailedException
     */
    public function __construct(string $title)
    {
        $this->guard($title);
        $this->title = $title;
    }

    /**
     * @param ValueObjectInterface|CampaignTitle $product
     *
     * @return bool
     */
    public function equals(ValueObjectInterface $product): bool
    {
        if (!$product instanceof self) {
            return false;
        }

        return $this->title === $product->getTitle();
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * {@inheritdoc}
     */
    public function toString(): string
    {
        return $this->title;
    }

    /**
     * @param string $data
     *
     * @return CampaignTitle
     */
    public static function fromString(string $data): CampaignTitle
    {
        return new self($data);
    }

    /**
     * @param string $title
     *
     * @throws AssertionFailedException
     */
    private function guard(string $title): void
    {
        Assertion::maxLength($title, 120, null, self::errorPropertyPath());
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->title;
    }
}
