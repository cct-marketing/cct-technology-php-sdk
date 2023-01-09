<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel;

use Assert\Assertion;
use CCT\SDK\Campaign\Data\AdContent\Image\Image;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class FacebookCarouselCard extends AbstractMulti
{
    public function __construct(public readonly string $heading, public readonly string $description, public readonly ?Image $image = null)
    {
        $this->guard($heading, $description);
    }

    public static function fromImage(Image $image): self
    {
        return new self('', '', $image);
    }

    public static function emptyContent(): self
    {
        return new self('', '', null);
    }

    private function guard(string $heading, string $description)
    {
        Assertion::maxLength($heading, 60, null, self::errorPropertyPath());
        Assertion::maxLength($description, 40, null, self::errorPropertyPath());
    }

    public static function fromArray(array $data): static
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
            'image' => $this->image?->toArray(),
        ];
    }

    public function withImage(?Image $image): self
    {
        return new self(
            $this->heading,
            $this->description,
            $image
        );
    }
}
