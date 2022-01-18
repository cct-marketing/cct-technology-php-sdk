<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class UserSelected extends AbstractValueObject
{
    /**
     * @var boolean;
     */
    private $selected;

    /**
     * @param bool $selected
     *
     * @return self
     *
     * @throws AssertionFailedException
     */
    public static function fromBool(bool $selected): self
    {
        return new self($selected);
    }

    /**
     * @param mixed $selected
     *
     * @return self
     *
     * @throws AssertionFailedException
     */
    public static function fromMixed($selected): self
    {
        return new self($selected);
    }

    /**
     *  constructor.
     *
     * @param mixed $selected
     *
     * @throws AssertionFailedException
     */
    private function __construct($selected)
    {
        $this->guard($selected);
        $this->selected = in_array($selected, [true, 1, 'true', '1'], true);
    }

    /**
     * @return bool
     */
    public function toBool(): bool
    {
        return $this->selected;
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

        return $this->selected === $valueObject->isSelected();
    }

    /**
     * @return bool
     */
    public function isSelected(): bool
    {
        return $this->selected;
    }

    /**
     * @return bool
     */
    public function serialize(): bool
    {
        return $this->selected;
    }

    /**
     * {@inheritdoc}
     */
    public static function deserialize($data): self
    {
        return self::fromMixed($data);
    }

    /**
     * @param mixed $selected
     *
     * @throws AssertionFailedException
     */
    private function guard($selected)
    {
        Assertion::inArray($selected, [true, false, 'true', 'false', '0', '1', 0, 1]);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->isSelected() ? 'true' : 'false';
    }
}
