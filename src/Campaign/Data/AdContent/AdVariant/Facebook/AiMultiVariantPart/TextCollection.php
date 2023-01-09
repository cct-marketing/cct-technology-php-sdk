<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart;

use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractCollection;

final class TextCollection extends AbstractCollection
{
    public static function fromArray(array $data): static
    {
        return new self(array_map(
            static function (string $text) {
                return Text::fromString($text);
            },
            $data
        ));
    }

    public function toArray(): array
    {
        return array_map(
            static function (Text $text) {
                return $text->toString();
            },
            $this->items
        );
    }

    protected function guard(array $items): void
    {
        parent::guard($items);
        Assertion::minCount($items, 1, self::errorPropertyPath());
        Assertion::maxCount($items, 5, self::errorPropertyPath());
        Assertion::noDuplicates($items, self::errorPropertyPath());
    }

    protected static function itemClassName(): string
    {
        return Text::class;
    }
}
