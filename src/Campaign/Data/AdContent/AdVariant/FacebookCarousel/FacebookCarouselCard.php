<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel;

use Assert\Assertion;
use CCT\SDK\Campaign\Data\AdContent\Image\Image;
use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
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

    public function withImage(?Image $image): self
    {
        return new self(
            $this->heading,
            $this->description,
            $image
        );
    }
}
