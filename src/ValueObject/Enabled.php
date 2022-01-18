<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ValueObject;

use Assert\Assertion;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

class Enabled extends AbstractValueObject
{
    /**
     * @var boolean;
     */
    private $enabled;

    /**
     * @param bool $enabled
     *
     * @return self
     */
    public static function fromBool(bool $enabled): self
    {
        return new self($enabled);
    }

    /**
     * @param mixed $enabled
     *
     * @return self
     */
    public static function fromMixed($enabled): self
    {
        return new self($enabled);
    }

    /**
     * Enabled constructor.
     *
     * @param mixed $enabled
     */
    public function __construct($enabled)
    {
        $this->guard($enabled);
        $this->enabled = in_array($enabled, [true, 1, 'true', '1'], true);
    }

    /**
     * @return bool
     */
    public function toBool(): bool
    {
        return $this->enabled;
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

        return $this->enabled === $valueObject->isEnabled();
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param mixed $enabled
     */
    private function guard($enabled)
    {
        Assertion::inArray($enabled, [true, false, 'true', 'false', '0', '1', 0, 1]);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->isEnabled() ? 'true' : 'false';
    }
}
