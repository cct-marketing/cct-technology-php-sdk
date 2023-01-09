<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\AdVariant\Google;

use CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\DescriptionCollection;
use CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\LongHeadline;
use CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\ShortHeadlineCollection;
use CCT\SDK\Campaign\Data\AdContent\Image\ImageCollection;
use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class GoogleResponsiveAdVariant extends AbstractMulti
{
    private function __construct(
        public readonly ShortHeadlineCollection $shortHeadlineCollection,
        public readonly LongHeadline $longHeadline,
        public readonly DescriptionCollection $descriptionCollection,
        public readonly ImageCollection $imageCollection
    ) {
    }

    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'short_headlines', self::errorPropertyPath());
        Assertion::keyExists($data, 'long_headline', self::errorPropertyPath());
        Assertion::keyExists($data, 'descriptions', self::errorPropertyPath());

        return new self(
            ShortHeadlineCollection::fromArray($data['short_headlines']),
            LongHeadline::fromString($data['long_headline']),
            DescriptionCollection::fromArray($data['descriptions']),
            isset($data['images']) ? ImageCollection::fromArray($data['images']) : ImageCollection::emptyList()
        );
    }

    public function toArray(): array
    {
        return [
            'short_headlines' => $this->shortHeadlineCollection->toArray(),
            'long_headline' => $this->longHeadline->toString(),
            'descriptions' => $this->descriptionCollection->toArray(),
            'images' => $this->imageCollection->toArray(),
        ];
    }
}
