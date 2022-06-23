<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\CampaignImage\ChannelImage;

use Assert\Assertion;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ValueObject\ChannelName;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\Image\ImageCollection;

final class LinkedInImages extends AbstractValueObject implements ImageChannelInterface
{
    /**
     * @var ImageCollection
     */
    private $images;

    /**
     * LinkedInImages constructor.
     */
    public function __construct(ImageCollection $images)
    {
        $this->images = $images;
    }

    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $this->toArray() === $valueObject->toArray();
    }

    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'images', null, 'linked_in_images');

        return new self(
            ImageCollection::fromArray($data['images'])
        );
    }

    public function toArray(): array
    {
        return [
            'images' => $this->images->toArray(),
        ];
    }

    public function __toString(): string
    {
        return (string) json_encode($this->toArray());
    }

    /**
     * Count images of an object
     */
    public function count(): int
    {
        return $this->images->count();
    }

    /**
     * Return the channel name.
     */
    public function getChannelName(): ChannelName
    {
        return new ChannelName('linked_in');
    }

    public function images(): ImageCollection
    {
        return $this->images;
    }
}
