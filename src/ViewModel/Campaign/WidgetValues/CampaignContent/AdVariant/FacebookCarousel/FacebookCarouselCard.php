<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\AdVariant\FacebookCarousel;

use Assert\Assertion;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\Image\Image;

final class FacebookCarouselCard extends AbstractValueObject
{
    /**
     * @var string
     */
    private $heading;

    /**
     * @var string
     */
    private $description;

    /**
     * @var Image|null
     */
    private $image;

    /**
     * FacebookAdVariant constructor.
     */
    public function __construct(string $heading, string $description, ?Image $image = null)
    {
        $this->guard($heading, $description);
        $this->heading = $heading;
        $this->description = $description;
        $this->image = $image;
    }

    /**
     * @return FacebookCarouselCard
     */
    public static function fromImage(Image $image): self
    {
        return new self('', '', $image);
    }

    /**
     * @return FacebookCarouselCard
     */
    public static function emptyContent(): self
    {
        return new self('', '', null);
    }

    private function guard(string $heading, string $description)
    {
        Assertion::maxLength($heading, 60, null, self::errorPropertyPath());
        Assertion::maxLength($description, 40, null, self::errorPropertyPath());
    }

    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'heading', null, 'facebook_carousel_card');
        Assertion::keyExists($data, 'description', null, 'facebook_carousel_card');

        return new self(
            $data['heading'],
            $data['description'],
            isset($data['image']) ? Image::fromArray($data['image']) : null
        );
    }

    public function toArray(): array
    {
        return [
            'heading' => $this->heading,
            'description' => $this->description,
            'image' => $this->image ? $this->image->toArray() : null,
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

    /**
     * @return FacebookCarouselCard
     */
    public function withImage(?Image $image): self
    {
        return new self(
            $this->heading,
            $this->description,
            $image
        );
    }

    public function isEmpty(): bool
    {
        return '' === $this->heading;
    }
}
