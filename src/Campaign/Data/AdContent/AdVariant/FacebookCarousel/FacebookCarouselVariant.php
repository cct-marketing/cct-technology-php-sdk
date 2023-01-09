<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\AdVariant\FacebookCarousel;

use CCT\SDK\Campaign\Data\AdContent\Image\ImageCollection;
use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

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

    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'text', self::errorPropertyPath());
        Assertion::keyExists($data, 'card_collection', self::errorPropertyPath());

        return new self(
            $data['text'],
            FacebookCarouselCardCollection::fromArray($data['card_collection'])
        );
    }

    public function toArray(): array
    {
        return [
            'text' => $this->text,
            'card_collection' => $this->cardCollection->toArray(),
        ];
    }

    public function withImages(ImageCollection $images): self
    {
        return new self(
            $this->text,
            $this->cardCollection->withImages($images)
        );
    }
}
