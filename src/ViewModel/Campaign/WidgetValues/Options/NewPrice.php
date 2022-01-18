<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\Options;

use Assert\Assertion;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ValueObject\Enabled;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class NewPrice extends AbstractValueObject
{
    /**
     * @var Enabled
     */
    private $enabled;

    /**
     * NewPrice constructor.
     *
     * @param Enabled $enabled
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
    public static function fromArray($data): self
    {
        Assertion::isArray($data, '', self::errorPropertyPath());
        Assertion::keyExists($data, 'enabled', '', self::errorPropertyPath());

        return new self(Enabled::fromMixed($data['enabled']));
    }

    /**
     * True to apply pricing to campaign total, otherwise false
     *
     * @return bool
     */
    public function applyPricing(): bool
    {
        return $this->enabled->isEnabled();
    }

    /**
     * @return bool
     */
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
