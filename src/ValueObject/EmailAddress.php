<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ValueObject;

use Assert\Assertion;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

class EmailAddress extends AbstractValueObject
{
    /**
     * @var string
     */
    private $email;

    /**
     * @return static
     * @psalm-suppress UnsafeInstantiation
     */
    public static function fromString(string $email)
    {
        return new static($email);
    }

    /**
     * AgentEmail constructor.
     */
    private function __construct(string $email)
    {
        $this->guard($email);
        $this->email = $email;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function toString(): string
    {
        return $this->email;
    }

    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $this->email === $valueObject->email();
    }

    public function __toString(): string
    {
        return $this->email;
    }

    private function guard(string $email): void
    {
        Assertion::email($email, null, self::errorPropertyPath());
    }
}
