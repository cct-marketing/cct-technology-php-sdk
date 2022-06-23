<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\Notification;

use Assert\Assertion;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ValueObject\Enabled;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class Notification extends AbstractValueObject
{
    /**
     * @var Enabled
     */
    private $enabled;

    /**
     * @var ContactCollection
     */
    private $contactCollection;

    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'enabled', null, self::errorPropertyPath());
        Assertion::keyExists($data, 'contacts', null, self::errorPropertyPath());

        return new self(
            Enabled::fromMixed($data['enabled']),
            ContactCollection::fromArray($data['contacts'])
        );
    }

    /**
     * Notification constructor.
     */
    public function __construct(Enabled $enabled, ContactCollection $contactCollection)
    {
        $this->enabled = $enabled;
        $this->contactCollection = $contactCollection;
    }

    public function toArray(): array
    {
        return [
            'enabled' => $this->enabled->toBool(),
            'contacts' => $this->contactCollection->toArray(),
        ];
    }

    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $this->toArray() === $valueObject->toArray();
    }

    public function __toString(): string
    {
        return (string) json_encode($this->toArray());
    }

    public function isEnabled(): bool
    {
        return $this->enabled->isEnabled();
    }
}
