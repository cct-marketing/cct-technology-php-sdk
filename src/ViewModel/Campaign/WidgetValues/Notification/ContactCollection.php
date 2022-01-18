<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\Notification;

use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class ContactCollection extends AbstractValueObject
{
    /**
     * @var Contact[]
     */
    private $contacts;

    /**
     * @param array $contacts
     *
     * @return self
     */
    public static function fromArray(array $contacts): self
    {
        return new self(...array_map(static function (array $contact) {
            return Contact::fromArray($contact);
        }, $contacts));
    }

    /**
     * @param Contact ...$contacts
     *
     * @return self
     */
    public static function fromItems(Contact ...$contacts): self
    {
        return new self(...$contacts);
    }

    /**
     * @param array<Contact> $contacts
     * @param array          $settings
     *
     * @return self
     */
    public static function fromItemsWithSettings(array $contacts, array $settings): self
    {
        $self = new self(...$contacts);

        // Limit $contactCollection to max setting
        if (false === isset($settings['max'])
            || !is_int($settings['max'])
            || $self->editableContacts()->count() <= $settings['max']
        ) {
            return $self;
        }

        $limit = $settings['max'];
        $limitedContacts = $self->limitEditableContacts($limit);

        return new self(...$limitedContacts);
    }

    /**
     * @return self
     */
    public static function emptyList(): self
    {
        return new self();
    }

    /**
     * Constructor.
     *
     * @param Contact ...$contacts
     */
    private function __construct(Contact ...$contacts)
    {
        $this->contacts = $contacts;
    }

    /**
     * @param Contact $contact
     *
     * @return self
     */
    public function push(Contact $contact): self
    {
        $copy = clone $this;
        $copy->contacts[] = $contact;

        return $copy;
    }

    /**
     * @return self
     */
    public function pop(): self
    {
        $copy = clone $this;
        array_pop($copy->contacts);

        return $copy;
    }

    /**
     * @return Contact|null
     */
    public function first(): ?Contact
    {
        return $this->contacts[0] ?? null;
    }

    /**
     * @return Contact|null
     */
    public function last(): ?Contact
    {
        if (count($this->contacts) === 0) {
            return null;
        }

        return $this->contacts[count($this->contacts) - 1];
    }

    /**
     * @param Contact $contact
     *
     * @return bool
     */
    public function contains(Contact $contact): bool
    {
        foreach ($this->contacts as $existingContact) {
            if ($existingContact->equals($contact)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return Contact[]
     */
    public function contacts(): array
    {
        return $this->contacts;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_map(static function (Contact $contact) {
            return $contact->toArray();
        }, $this->contacts);
    }

    /**
     * @param ValueObjectInterface $other
     *
     * @return bool
     */
    public function equals(ValueObjectInterface $other): bool
    {
        if (!$other instanceof self) {
            return false;
        }

        return $this->toArray() === $other->toArray();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) json_encode($this->toArray());
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->contacts);
    }
}
