<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\Options;

use Assert\Assertion;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ValueObject\Enabled;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class FacebookSlideshow extends AbstractValueObject
{
    /**
     * @var Enabled
     */
    private $enabled;

    /**
     * FacebookSlideshow constructor.
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
    public static function fromArray(array $data): FacebookSlideshow
    {
        Assertion::keyExists($data, 'enabled', '', self::errorPropertyPath());

        return new self(Enabled::fromMixed($data['enabled']));
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled->isEnabled();
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

        return $this->enabled->isEnabled() === $valueObject->isEnabled();
    }
}
