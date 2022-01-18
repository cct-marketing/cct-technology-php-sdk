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
     * @param string $email
     *
     * @return static
     */
    public static function fromString(string $email)
    {
        return new static($email);
    }

    /**
     * AgentEmail constructor.
     *
     * @param string $email
     */
    private function __construct(string $email)
    {
        $this->guard($email);
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function email(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->email;
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

        return $this->email === $valueObject->email();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    private function guard(string $email): void
    {
        Assertion::email($email, null, self::errorPropertyPath());
    }
}
