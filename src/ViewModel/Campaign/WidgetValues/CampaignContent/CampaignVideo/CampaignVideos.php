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
     * @param array $data
     *
     * @return self
     *
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

    /**
     * @param VideoCollection $videoCollection
     * @param UserSelected    $userSelected
     *
     * @return self
     */
    public static function create(
        VideoCollection $videoCollection,
        UserSelected $userSelected
    ): self {
        return new self($videoCollection, $userSelected);
    }

    /**
     * CampaignVideos constructor.
     *
     * @param VideoCollection $videoCollection
     * @param UserSelected    $userSelected
     */
    private function __construct(
        VideoCollection $videoCollection,
        UserSelected $userSelected
    ) {
        $this->videoCollection = $videoCollection;
        $this->userSelected = $userSelected;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'videos' => $this->videoCollection->toArray(),
            'user_selected' => $this->userSelected->toBool(),
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
     * @return bool
     */
    public function isUserSelected(): bool
    {
        return $this->userSelected->isSelected();
    }

    /**
     * @return VideoCollection
     */
    public function videoCollection(): VideoCollection
    {
        return $this->videoCollection;
    }

    /**
     * Count of all videos
     *
     * @return int
     */
    public function count(): int
    {
        return $this->videoCollection->count();
    }

    /**
     * @param VideoCollection $videos
     *
     * @return self
     */
    public function withVideos(VideoCollection $videos): self
    {
        return new self(
            $videos,
            $this->userSelected
        );
    }
}
