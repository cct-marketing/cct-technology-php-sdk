<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\Options;

use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ValueObject\Enabled;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class PostFirstVariantToFacebook extends AbstractValueObject
{
    /**
     * @var Enabled;
     */
    private $enabled;

    /**
     * PostFirstVariantToFacebook constructor.
     */
    public function __construct(Enabled $enabled)
    {
        $this->enabled = $enabled;
    }

    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $this->enabled->isEnabled() === $valueObject->isEnabled();
    }

    public function isEnabled(): bool
    {
        return $this->enabled->isEnabled();
    }

    /**
     * {@inheritdoc}
     */
    public function toBool()
    {
        return $this->enabled->isEnabled();
    }

    /**
     * {@inheritdoc}
     */
    public static function fromMixed($data): self
    {
        $enabled = $data['enabled'] ?? $data;

        return new self(Enabled::fromMixed($enabled));
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->isEnabled() ? 'true' : 'false';
    }
}
