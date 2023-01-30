<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel;

use CCT\SDK\Campaign\Data\AdContent\Image\ImageCollection;
use CCT\SDK\Infrastructure\Assert\Assertion;
use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class FacebookCarouselVariant extends AbstractMulti
{
    public function __construct(public readonly string $text, public readonly FacebookCarouselCardCollection $cardCollection)
    {
        $this->guard($text, $cardCollection);
    }

    private function guard(string $text, FacebookCarouselCardCollection $cardCollection)
    {
        Assertion::maxLength($text, 200, self::errorPropertyPath());
    }

    public function withImages(ImageCollection $images): self
    {
        return new self(
            $this->text,
            $this->cardCollection->withImages($images)
        );
    }
}
