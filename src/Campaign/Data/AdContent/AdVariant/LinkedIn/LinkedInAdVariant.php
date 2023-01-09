<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\AdVariant\LinkedIn;

use CCT\SDK\Campaign\Data\AdContent\Image\ImageCollection;
use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class LinkedInAdVariant extends AbstractMulti
{
    public function __construct(public readonly string $text, public readonly ?ImageCollection $imageCollection = null)
    {
        $this->guard($text);
    }

    public function toArray(): array
    {
        return [
            'text' => $this->text,
            'images' => $this->imageCollection?->toArray(),
        ];
    }

    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'text', 'linked_in_ad_variant');

        return new self(
            $data['text'],
            isset($data['images']) ? ImageCollection::fromArray($data['images']) : null
        );
    }

    private function guard(string $text): void
    {
        Assertion::maxLength($text, 200, 'linked_in_ad_variant');
    }
}
