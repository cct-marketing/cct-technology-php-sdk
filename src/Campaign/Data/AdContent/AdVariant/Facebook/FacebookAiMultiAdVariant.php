<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook;

use CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\DescriptionCollection;
use CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\HeadingCollection;
use CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\TextCollection;
use CCT\SDK\Campaign\Data\AdContent\Image\ImageCollection;
use CCT\SDK\Campaign\Data\AdContent\Video\VideoCollection;
use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class FacebookAiMultiAdVariant extends AbstractMulti
{
    public function __construct(
        public readonly TextCollection $texts,
        public readonly HeadingCollection $headings,
        public readonly DescriptionCollection $descriptions,
        public readonly ImageCollection $images,
        public readonly VideoCollection $videos
    ) {
    }

    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'headings', self::errorPropertyPath());
        Assertion::keyExists($data, 'texts', self::errorPropertyPath());
        Assertion::keyExists($data, 'descriptions', self::errorPropertyPath());

        return new self(
            TextCollection::fromArray($data['texts']),
            HeadingCollection::fromArray($data['headings']),
            DescriptionCollection::fromArray($data['descriptions']),
            isset($data['images']) ? ImageCollection::fromArray($data['images']) : ImageCollection::emptyList(),
            isset($data['videos']) ? VideoCollection::fromArray($data['videos']) : VideoCollection::emptyList(),
        );
    }

    public function toArray(): array
    {
        return [
            'texts' => $this->texts->toArray(),
            'headings' => $this->headings->toArray(),
            'descriptions' => $this->descriptions->toArray(),
            'images' => $this->images->toArray(),
            'videos' => $this->videos->toArray(),
        ];
    }
}
