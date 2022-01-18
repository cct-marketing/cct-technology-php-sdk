<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\AdVariant\Facebook;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\Image\ImageCollection;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\Video\VideoCollection;

final class FacebookAdVariant extends AbstractValueObject
{
    /**
     * @var string
     */
    private $heading;

    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $description;

    /**
     * @var ImageCollection|null
     */
    private $imageCollection;

    /**
     * @var VideoCollection|null
     */
    private $videoCollection;

    /**
     * FacebookAdVariant constructor.
     *
     * @param string               $heading
     * @param string               $text
     * @param string               $description
     * @param ImageCollection|null $imageCollection
     * @param VideoCollection|null $videoCollection
     *
     * @throws AssertionFailedException
     */
    public function __construct(
        string $heading,
        string $text,
        string $description,
        ?ImageCollection $imageCollection = null,
        ?VideoCollection $videoCollection = null
    ) {
        $this->guard($heading, $text, $description);
        $this->heading = $heading;
        $this->text = $text;
        $this->description = $description;
        $this->imageCollection = $imageCollection;
        $this->videoCollection = $videoCollection;
    }

    /**
     * @return string
     */
    public function getHeading(): string
    {
        return $this->heading;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $heading
     * @param string $text
     * @param string $description
     *
     * @throws AssertionFailedException
     */
    private function guard(string $heading, string $text, string $description)
    {
        Assertion::maxLength($heading, 50, null, self::errorPropertyPath());
        Assertion::maxLength($text, 200, null, self::errorPropertyPath());
        Assertion::maxLength($description, 200, null, self::errorPropertyPath());
    }

    /**
     * @param array $data
     *
     * @return self
     *
     * @throws AssertionFailedException
     */
    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'heading', null, self::errorPropertyPath());
        Assertion::keyExists($data, 'text', null, self::errorPropertyPath());
        Assertion::keyExists($data, 'description', null, self::errorPropertyPath());

        return new self(
            $data['heading'],
            $data['text'],
            $data['description'],
            isset($data['images']) ? ImageCollection::fromArray($data['images']) : null,
            isset($data['videos']) ? VideoCollection::fromArray($data['videos']) : null
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'heading' => $this->heading,
            'text' => $this->text,
            'description' => $this->description,
            'images' => $this->imageCollection ? $this->imageCollection->toArray() : null,
            'videos' => $this->videoCollection ? $this->videoCollection->toArray() : null,
        ];
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
     * @return string
     */
    public function __toString(): string
    {
        return (string) json_encode($this->toArray());
    }

    /**
     * Variant has no text
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->heading === '' && $this->text === '' && $this->description === '';
    }

    /**
     * @param ImageCollection $images
     *
     * @return FacebookAdVariant
     *
     * @throws AssertionFailedException
     */
    public function withImages(ImageCollection $images): self
    {
        return new self(
            $this->heading,
            $this->text,
            $this->description,
            $images
        );
    }

    /**
     * @param VideoCollection $videos
     *
     * @return self
     *
     * @throws AssertionFailedException
     */
    public function withVideos(VideoCollection $videos): self
    {
        return new self(
            $this->heading,
            $this->text,
            $this->description,
            $this->imageCollection,
            $videos
        );
    }
}
