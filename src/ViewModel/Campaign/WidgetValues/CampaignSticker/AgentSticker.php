<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignSticker;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ValueObject\Enabled;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class AgentSticker extends AbstractValueObject
{
    /**
     * @var Enabled
     */
    private $enabled;

    /**
     * @var UuidInterface|null
     */
    private $templateUuid;

    /**
     * @var UuidInterface|null
     */
    private $stickerUuid;

    /**
     * @var int|null
     */
    private $stickerVersion;

    /**
     * @param array $data
     *
     * @return AgentSticker
     *
     * @throws AssertionFailedException
     */
    public static function fromArray(array $data): AgentSticker
    {
        Assertion::keyExists($data, 'enabled', null, self::errorPropertyPath());

        return new static(
            Enabled::fromMixed($data['enabled']),
            isset($data['template_uuid']) ? Uuid::fromString($data['template_uuid']) : null,
            isset($data['sticker_uuid']) ? Uuid::fromString($data['sticker_uuid']) : null,
            isset($data['sticker_version']) ? (int) $data['sticker_version'] : null
        );
    }

    /**
     * AgentSticker constructor.
     *
     * @param Enabled            $enabled
     * @param UuidInterface|null $templateUuid
     * @param UuidInterface|null $stickerUuid
     * @param int|null           $stickerVersion
     *
     * @throws AssertionFailedException
     */
    public function __construct(
        Enabled $enabled,
        ?UuidInterface $templateUuid,
        ?UuidInterface $stickerUuid,
        ?int $stickerVersion
    ) {
        $this->guard($enabled, $templateUuid, $stickerUuid, $stickerVersion);
        $this->enabled = $enabled;
        $this->templateUuid = $templateUuid;
        $this->stickerUuid = $stickerUuid;
        $this->stickerVersion = $stickerVersion;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled->isEnabled();
    }

    /**
     * @return UuidInterface|null
     */
    public function templateUuid(): ?UuidInterface
    {
        return $this->templateUuid;
    }

    /**
     * @return UuidInterface|null
     */
    public function stickerUuid(): ?UuidInterface
    {
        return $this->stickerUuid;
    }

    /**
     * @return int|null
     */
    public function stickerVersion(): ?int
    {
        return $this->stickerVersion;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return $this->toArray();
    }

    /**
     * @param mixed $data
     *
     * @return self
     *
     * @throws AssertionFailedException
     */
    public static function deserialize($data): self
    {
        Assertion::isArray($data, null, self::errorPropertyPath());

        return self::fromArray($data);
    }

    /**
     * Verifies whether the specific object equals this one.
     *
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
     * True to apply pricing to campaign total, otherwise false
     *
     * @return bool
     */
    public function applyPricing(): bool
    {
        return $this->enabled->isEnabled();
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'enabled' => $this->enabled->toBool(),
            'template_uuid' => $this->templateUuid ? $this->templateUuid->toString() : null,
            'sticker_uuid' => $this->stickerUuid ? $this->stickerUuid->toString() : null,
            'sticker_version' => $this->stickerVersion ? (int) $this->stickerVersion : null,
        ];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) json_encode($this->toArray());
    }

    /**
     * @param Enabled            $enabled
     * @param UuidInterface|null $templateUuid
     * @param UuidInterface|null $stickerUuid
     * @param int|null           $stickerVersion
     *
     * @throws AssertionFailedException
     */
    private function guard(
        Enabled $enabled,
        ?UuidInterface $templateUuid,
        ?UuidInterface $stickerUuid,
        ?int $stickerVersion
    ): void {
        Assertion::nullOrInteger($stickerVersion, null, self::errorPropertyPath());

        if ($enabled->isEnabled()) {
            Assertion::notNull($templateUuid, null, self::errorPropertyPath() . '.template_uuid');
            Assertion::notNull($stickerUuid, null, self::errorPropertyPath() . '.sticker_uuid');
            Assertion::min($stickerVersion, 1, null, self::errorPropertyPath() . '.sticker_version');
        }
    }
}
