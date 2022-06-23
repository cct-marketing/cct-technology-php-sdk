<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\Options;

use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class Options extends AbstractValueObject
{
    /**
     * @var AdvancedSlideshow|null
     */
    private $advancedSlideshow;

    /**
     * @var SaveAsTemplate | null
     */
    private $saveAsTemplate;

    /**
     * Options constructor.
     */
    public function __construct(?AdvancedSlideshow $advancedSlideshow, ?SaveAsTemplate $saveAsTemplate)
    {
        $this->advancedSlideshow = $advancedSlideshow;
        $this->saveAsTemplate = $saveAsTemplate;
    }

    /**
     * @throws AssertionFailedException
     */
    public static function fromArray(array $data): self
    {
        return new self(
            isset($data['advanced_slideshow']) ? AdvancedSlideshow::fromArray($data['advanced_slideshow']) : null,
            isset($data['save_as_template']) ? SaveAsTemplate::fromArray($data['save_as_template']) : null
        );
    }

    public function toArray(): array
    {
        return [
            'advanced_slideshow' => $this->advancedSlideshow ? $this->advancedSlideshow->toArray() : null,
            'save_as_template' => $this->saveAsTemplate ? $this->saveAsTemplate->toArray() : null,
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

    public function advancedSlideshow(): ?AdvancedSlideshow
    {
        return $this->advancedSlideshow;
    }

    public function saveAsTemplate(): ?SaveAsTemplate
    {
        return $this->saveAsTemplate;
    }
}
