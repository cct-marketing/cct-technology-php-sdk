<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\AdVariant\Google;

use CCT\SDK\Campaign\Data\AdContent\Image\ImageCollection;
use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class GoogleAdVariant extends AbstractMulti
{
    public function __construct(public readonly string $textLine1, public readonly string $textLine2, public readonly ?ImageCollection $imageCollection = null)
    {
        $this->guard($textLine1, $textLine2);
    }

    public function toArray(): array
    {
        return [
            'text_line_1' => $this->textLine1,
            'text_line_2' => $this->textLine2,
            'images' => $this->imageCollection?->toArray(),
        ];
    }

    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'text_line_1', 'google_ad_variant');
        Assertion::keyExists($data, 'text_line_2', 'google_ad_variant');

        return new self(
            $data['text_line_1'],
            $data['text_line_2'],
            isset($data['images']) ? ImageCollection::fromArray($data['images']) : null
        );
    }

    private function guard(string $textLine1, string $textLine2): void
    {
        Assertion::maxLength($textLine1, 45, 'google_ad_variant');
        Assertion::maxLength($textLine2, 45, 'google_ad_variant');
    }
}
