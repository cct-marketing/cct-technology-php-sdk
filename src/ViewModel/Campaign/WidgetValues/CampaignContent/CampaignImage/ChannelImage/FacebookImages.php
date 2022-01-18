<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\CampaignImage\ChannelImage;

use Assert\Assertion;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ValueObject\ChannelName;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\Image\ImageCollection;

final class FacebookImages extends AbstractValueObject implements ImageChannelInterface
{
    /**
     * @var ImageCollection
     */
    private $images;

    /**
     * FacebookImages constructor.
     *
     * @param ImageCollection $images
     */
    public function __construct(ImageCollection $images)
    {
        $this->images = $images;
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

        return $this->toArray() === $valueObject->toArray();
    }

    /**
     * Return the channel name.
     *
     * @return ChannelName
     */
    public function getChannelName(): ChannelName
    {
        return new ChannelName('facebook');
    }

    /**
     * @param array $data
     *
     * @return FacebookImages
     */
    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'images', null, 'facebook_images');

        return new self(
            ImageCollection::fromArray($data['images'])
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'images' => $this->images->toArray(),
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
     * @return int
     */
    public function count(): int
    {
        return $this->images->count();
    }

    /**
     * @return ImageCollection
     */
    public function images(): ImageCollection
    {
        return $this->images;
    }
}
