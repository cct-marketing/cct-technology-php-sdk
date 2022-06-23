<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent;

use Assert\Assertion;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ValueObject\Enabled;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class AdText extends AbstractValueObject
{
    /**
     * @var Enabled
     */
    private $enabled;

    /**
     * FacebookSlideshow constructor.
     */
    public function __construct(Enabled $enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        return [
            'enabled' => $this->enabled->isEnabled(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'enabled', '', self::errorPropertyPath());

        return new self(Enabled::fromMixed($data['enabled']));
    }

    public function isEnabled(): bool
    {
        return $this->enabled->isEnabled();
    }

    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $this->enabled->isEnabled() === $valueObject->isEnabled();
    }
}
