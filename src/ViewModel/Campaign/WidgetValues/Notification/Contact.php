<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\Notification;

use Assert\Assertion;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ValueObject\ContactType;
use CCT\SDK\CampaignWizard\ValueObject\EmailAddress;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class Contact extends AbstractValueObject
{
    /**
     * @var ContactType
     */
    private $contactType;

    /**
     * @var EmailAddress
     */
    private $email;

    /**
     * @var bool
     */
    private $editable;

    /**
     * @var bool
     */
    private $show;

    /**
     * @var bool
     */
    private $alwaysSend;

    /**
     * @param array $data
     *
     * @return self
     */
    public static function fromArray(array $data): self
    {
        Assertion::keyIsset($data, 'contact_type', null, 'contact');
        Assertion::keyIsset($data, 'email', null, 'contact');
        Assertion::keyIsset($data, 'editable', null, 'contact');
        Assertion::keyIsset($data, 'show', null, 'contact');
        Assertion::keyIsset($data, 'always_send', null, 'contact');

        return new self(
            ContactType::fromString($data['contact_type']),
            EmailAddress::fromString($data['email']),
            $data['editable'],
            $data['show'],
            $data['always_send']
        );
    }

    /**
     * Contact constructor.
     *
     * @param ContactType  $contactType
     * @param EmailAddress $email
     * @param bool         $editable
     * @param bool         $show
     * @param bool         $alwaysSend
     */
    private function __construct(
        ContactType $contactType,
        EmailAddress $email,
        bool $editable,
        bool $show,
        bool $alwaysSend
    ) {
        $this->contactType = $contactType;
        $this->email = $email;

        if ($contactType->toString() === ContactType::USER_DEFINED_CONTACT || true === $editable) {
            $this->editable = true;
            $this->show = true;
            $this->alwaysSend = false;

            return;
        }

        $this->editable = $editable;
        $this->show = $show;
        $this->alwaysSend = $alwaysSend;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'contact_type' => $this->contactType->toString(),
            'email' => $this->email->toString(),
            'editable' => $this->editable,
            'show' => $this->show,
            'always_send' => $this->alwaysSend,
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
     * @return bool
     */
    public function isEditable(): bool
    {
        return $this->editable;
    }
}
