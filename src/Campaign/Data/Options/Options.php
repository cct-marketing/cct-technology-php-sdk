<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Options;

use Assert\AssertionFailedException;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class Options extends AbstractMulti
{
    public function __construct(
        public readonly ?AdvancedSlideshow $advancedSlideshow,
        public readonly ?FacebookSlideshow $facebookSlideshow,
        public readonly ?LocalBoost $localBoost,
        public readonly ?PostFirstVariantToFacebook $postFirstVariantToFacebook,
        public readonly ?AfterSoldAction $afterSoldAction
    ) {
    }

    /**
     * @throws AssertionFailedException
     */
    public static function fromArray(array $data): static
    {
        return new self(
            isset($data['advanced_slideshow']) ? AdvancedSlideshow::fromArray($data['advanced_slideshow']) : null,
            isset($data['facebook_slideshow']) ? FacebookSlideshow::fromArray($data['facebook_slideshow']) : null,
            isset($data['local_boost']) ? LocalBoost::fromArray($data['local_boost']) : null,
            isset($data['post_first_variant_to_facebook']) ? PostFirstVariantToFacebook::fromArray($data['post_first_variant_to_facebook']) : null,
            isset($data['after_sold_action']) ? AfterSoldAction::fromArray($data['after_sold_action']) : null
        );
    }

    public function toArray(): array
    {
        return [
            'advanced_slideshow' => $this->advancedSlideshow ? $this->advancedSlideshow->toArray() : null,
            'save_as_template' => $this->facebookSlideshow ? $this->facebookSlideshow->toArray() : null,
        ];
    }
}
