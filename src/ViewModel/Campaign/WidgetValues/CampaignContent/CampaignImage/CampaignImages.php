<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\CampaignImage;

use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\Image\Image;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\Image\ImageCollection;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\CampaignImage\ChannelImage\ChannelCollection;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\UserSelected;

final class CampaignImages extends AbstractValueObject
{
    /**
     * User has selected the images
     *
     * @var UserSelected
     */
    private $userImagesSelected;

    /**
     * @var ChannelCollection;
     */
    private $channelImages;

    /**
     * CampaignImages constructor.
     */
    public function __construct(ChannelCollection $channelImages, UserSelected $userImagesSelected)
    {
        $this->channelImages = $channelImages;
        $this->userImagesSelected = $userImagesSelected;
    }

    /**
     * @throws AssertionFailedException
     */
    public static function createEmpty(): self
    {
        return new self(
            ChannelCollection::emptyList(),
            UserSelected::fromBool(false)
        );
    }

    /**
     * @param ValueObjectInterface|CampaignImages $valueObject
     */
    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $this->toArray() === $valueObject->toArray();
    }

    public function getChannelImages(): ChannelCollection
    {
        return $this->channelImages;
    }

    public function hasUserSelectedImages(): bool
    {
        return $this->userImagesSelected->isSelected();
    }

    public function getUserImagesSelected(): UserSelected
    {
        return $this->userImagesSelected;
    }

    public function numberOfChannels(): int
    {
        return $this->getChannels()->count();
    }

    public function toArray(): array
    {
        return [
            'user_images_selected' => $this->userImagesSelected->toBool(),
            'channel_images' => $this->channelImages->toArray(),
        ];
    }

    /**
     * @param mixed $data
     *
     * @throws AssertionFailedException
     */
    public static function fromArray(array $data): self
    {
        return new self(
            ChannelCollection::fromArray($data['channel_images'] ?? []),
            UserSelected::fromBool($data['user_images_selected'] ?? false)
        );
    }

    public function getChannels(): ChannelCollection
    {
        return $this->channelImages;
    }

    public function isUserSelected(): bool
    {
        return $this->userImagesSelected->isSelected();
    }

    public function withChannelImages(ChannelCollection $channelImages): self
    {
        return new self(
            $channelImages,
            $this->userImagesSelected
        );
    }

    public function firstImage(): ?Image
    {
        if ($this->numberOfChannels() === 0) {
            return null;
        }

        $channels = $this->getChannels();

        $firstChannel = $channels->first();

        if (null === $firstChannel) {
            return null;
        }

        return $firstChannel->images()->first();
    }

    public function allImagesForAllChannels(): ImageCollection
    {
        if ($this->numberOfChannels() === 0) {
            return ImageCollection::emptyList();
        }

        return $this->channelImages->allImages();
    }

    /**
     * Count of all images
     */
    public function countItems(): int
    {
        return $this->allImagesForAllChannels()->count();
    }

    /**
     * {@inheritDoc}
     */
    public function count(): int
    {
        return $this->allImagesForAllChannels()->count();
    }
}
