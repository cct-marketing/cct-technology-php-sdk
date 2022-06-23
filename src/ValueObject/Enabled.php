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

    public static function fromBool(bool $enabled): self
    {
        return new self($enabled);
    }

    public static function fromMixed($enabled): self
    {
        return new self($enabled);
    }

    /**
     * Enabled constructor.
     */
    public function __construct($enabled)
    {
        $this->guard($enabled);
        $this->enabled = in_array($enabled, [true, 1, 'true', '1'], true);
    }

    public function toBool(): bool
    {
        return $this->enabled;
    }

    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $this->enabled === $valueObject->isEnabled();
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

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
