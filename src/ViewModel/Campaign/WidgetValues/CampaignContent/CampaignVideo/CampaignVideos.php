<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\CampaignVideo;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\Video\VideoCollection;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\UserSelected;

final class CampaignVideos extends AbstractValueObject
{
    /**
     * User has selected the images
     *
     * @var UserSelected
     */
    private $userSelected;

    /**
     * @var VideoCollection;
     */
    private $videoCollection;

    /**
     * @throws AssertionFailedException
     */
    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'user_selected', null, self::errorPropertyPath());

        return new self(
            isset($data['videos']) ? VideoCollection::fromArray($data['videos']) : VideoCollection::emptyList(),
            UserSelected::fromMixed($data['user_selected'])
        );
    }

    public static function create(
        VideoCollection $videoCollection,
        UserSelected $userSelected
    ): self {
        return new self($videoCollection, $userSelected);
    }

    /**
     * CampaignVideos constructor.
     */
    private function __construct(
        VideoCollection $videoCollection,
        UserSelected $userSelected
    ) {
        $this->videoCollection = $videoCollection;
        $this->userSelected = $userSelected;
    }

    public function toArray(): array
    {
        return [
            'videos' => $this->videoCollection->toArray(),
            'user_selected' => $this->userSelected->toBool(),
        ];
    }

    public function __toString(): string
    {
        return (string) json_encode($this->toArray());
    }

    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $this->toArray() === $valueObject->toArray();
    }

    public function isUserSelected(): bool
    {
        return $this->userSelected->isSelected();
    }

    public function videoCollection(): VideoCollection
    {
        return $this->videoCollection;
    }

    /**
     * Count of all videos
     */
    public function count(): int
    {
        return $this->videoCollection->count();
    }

    public function withVideos(VideoCollection $videos): self
    {
        return new self(
            $videos,
            $this->userSelected
        );
    }
}
