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

    public static function fromArray(array $contacts): self
    {
        return new self(...array_map(static function (array $contact) {
            return Contact::fromArray($contact);
        }, $contacts));
    }

    /**
     * @param Contact ...$contacts
     */
    public static function fromItems(Contact ...$contacts): self
    {
        return new self(...$contacts);
    }

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

    public function push(Contact $contact): self
    {
        $copy = clone $this;
        $copy->contacts[] = $contact;

        return $copy;
    }

    public function pop(): self
    {
        $copy = clone $this;
        array_pop($copy->contacts);

        return $copy;
    }

    public function first(): ?Contact
    {
        return $this->contacts[0] ?? null;
    }

    public function last(): ?Contact
    {
        if (count($this->contacts) === 0) {
            return null;
        }

        return $this->contacts[count($this->contacts) - 1];
    }

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

    public function toArray(): array
    {
        return array_map(static function (Contact $contact) {
            return $contact->toArray();
        }, $this->contacts);
    }

    public function equals(ValueObjectInterface $other): bool
    {
        if (!$other instanceof self) {
            return false;
        }

        return $this->toArray() === $other->toArray();
    }

    public function __toString(): string
    {
        return (string) json_encode($this->toArray());
    }

    public function count(): int
    {
        return count($this->contacts);
    }
}
