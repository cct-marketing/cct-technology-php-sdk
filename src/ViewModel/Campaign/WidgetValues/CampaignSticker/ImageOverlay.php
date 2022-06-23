<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignSticker;

use Assert\Assertion;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ValueObject\Enabled;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignSticker\Sticker\StickerCollection;

final class ImageOverlay extends AbstractValueObject
{
    /**
     * @var StickerCollection
     */
    private $stickers;

    /**
     * @var Enabled|mixed
     */
    private $enabled;

    /**
     * Comment constructor.
     */
    public function __construct(Enabled $enabled, StickerCollection $stickers)
    {
        $this->enabled = $enabled;
        $this->stickers = $stickers;
    }

    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'enabled', '', 'image_overlay');
        Assertion::keyExists($data, 'stickers', '', 'image_overlay');

        return new self(
            Enabled::fromMixed($data['enabled']),
            StickerCollection::fromArray($data['stickers'])
        );
    }

    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $this->toArray() === $valueObject->toArray();
    }

    public function stickers(): StickerCollection
    {
        return $this->stickers;
    }

    public function isEnabled(): bool
    {
        return $this->enabled->isEnabled();
    }

    public function toArray(): array
    {
        return [
            'enabled' => $this->enabled->toBool(),
            'stickers' => $this->stickers->toArray(),
        ];
    }

    public function __toString(): string
    {
        return (string) json_encode($this->toArray());
    }
}
