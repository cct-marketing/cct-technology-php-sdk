<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\Options;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ValueObject\Enabled;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\Video\Video;

final class AdvancedSlideshow extends AbstractValueObject
{
    /**
     * @var Enabled
     */
    private $enabled;

    /**
     * @var Video|null
     */
    private $video;

    /**
     * AdvancedSlideshow constructor.
     */
    public function __construct(Enabled $enabled, ?Video $video = null)
    {
        $this->enabled = $enabled;
        $this->video = $video;
    }

    /**
     * @throws AssertionFailedException
     */
    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'enabled', null, self::errorPropertyPath());

        return new self(
            Enabled::fromMixed($data['enabled']),
            isset($data['video']) ? Video::fromArray($data['video']) : null
        );
    }

    public function toArray(): array
    {
        return [
            'enabled' => $this->enabled->toBool(),
            'video' => $this->video ? $this->video->toArray() : null,
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
}
