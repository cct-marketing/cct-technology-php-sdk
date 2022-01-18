<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ValueObject;

use Assert\Assertion;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class ContactType extends AbstractValueObject
{
    public const MAIN_CONTACT = 'main_contact';
    public const CONTENT_CONTACT = 'content_contact';
    public const HOME_OWNER_CONTACT = 'home_owner_contact';
    public const BILLING_CONTACT = 'billing_contact';
    public const AGENT_CONTACT = 'agent_contact';
    public const USER_CONTACT = 'user_contact';
    public const USER_DEFINED_CONTACT = 'user_defined_contact';
    public const SPECIFIC_CONTACT = 'specific_contact';

    /**
     * @var string
     */
    private $type;

    /**
     * @param string $type
     *
     * @return self
     */
    public static function fromString(string $type): self
    {
        return new self($type);
    }

    /**
     * ContactType constructor.
     *
     * @param string $type
     */
    private function __construct(string $type)
    {
        $this->guard($type);
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->type;
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

        return $this->type === $valueObject->type();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    private function guard(string $type): void
    {
        Assertion::inArray($type, $this->typeList(), null, self::errorPropertyPath());
    }

    /**
     * @return array
     */
    private function typeList(): array
    {
        return [
            self::MAIN_CONTACT,
            self::CONTENT_CONTACT,
            self::HOME_OWNER_CONTACT,
            self::BILLING_CONTACT,
            self::AGENT_CONTACT,
            self::USER_CONTACT,
            self::USER_DEFINED_CONTACT,
            self::SPECIFIC_CONTACT,
        ];
    }
}
