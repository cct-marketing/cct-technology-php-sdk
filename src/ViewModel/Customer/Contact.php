<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Customer;

use Assert\Assertion;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class Contact extends AbstractValueObject
{
    /**
     * @var string
     */
    private $contactType;

    /**
     * @var string
     */
    private $email;

    /**
     * @param array $data
     *
     * @return self
     */
    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'contact_type', null, self::errorPropertyPath());
        Assertion::keyExists($data, 'email', null, self::errorPropertyPath());

        return new self(
            $data['contact_type'],
            $data['email']
        );
    }

    /**
     * Contact constructor.
     *
     * @param string  $contactType
     * @param string $email
     */
    private function __construct(string $contactType, string $email)
    {
        $this->contactType = $contactType;
        $this->email = $email;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'contact_type' => $this->contactType,
            'email' => $this->email,
        ];
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

        return $this->toArray() === $valueObject->toArray();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) json_encode($this->toArray());
    }

    /**
     * @return string
     */
    public function contactType(): string
    {
        return $this->contactType;
    }

    /**
     * @return string
     */
    public function email(): string
    {
        return $this->email;
    }
}
