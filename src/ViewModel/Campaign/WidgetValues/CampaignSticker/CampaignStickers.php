<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignSticker;

use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class CampaignStickers extends AbstractValueObject
{
    /**
     * @var ImageOverlay | null
     */
    private $imageOverlay;

    /**
     * @var AgentSticker | null
     */
    private $agentSticker;

    public static function fromArray(array $data): self
    {
        return new self(
            isset($data['image_overlay']) ? ImageOverlay::fromArray($data['image_overlay']) : null,
            isset($data['agent_sticker']) ? AgentSticker::fromArray($data['agent_sticker']) : null
        );
    }

    /**
     * CampaignStickers constructor
     */
    private function __construct(
        ?ImageOverlay $imageOverlay,
        ?AgentSticker $agentSticker
    ) {
        $this->imageOverlay = $imageOverlay;
        $this->agentSticker = $agentSticker;
    }

    public function toArray(): array
    {
        return [
            'image_overlay' => $this->imageOverlay ? $this->imageOverlay->toArray() : null,
            'agent_sticker' => $this->agentSticker ? $this->agentSticker->toArray() : null,
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

    public function imageOverlay(): ?ImageOverlay
    {
        return $this->imageOverlay;
    }

    public function agentSticker(): ?AgentSticker
    {
        return $this->agentSticker;
    }
}
