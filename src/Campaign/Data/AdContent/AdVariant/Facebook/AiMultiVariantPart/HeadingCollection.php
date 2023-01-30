<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart;

use CCT\SDK\Infrastructure\Assert\Assertion;
use CCT\SDK\Infrastructure\ValueObject\AbstractCollection;
use CCT\SDK\Infrastructure\ValueObject\CollectionWithSingleVOTrait;

final class HeadingCollection extends AbstractCollection
{
    use CollectionWithSingleVOTrait;

    protected function guard(array $items): void
    {
        parent::guard($items);
        Assertion::minCount($items, 1, self::errorPropertyPath());
        Assertion::maxCount($items, 5, self::errorPropertyPath());
        Assertion::noDuplicates($items, self::errorPropertyPath());
    }

    public static function itemClassName(): string
    {
        return Heading::class;
    }
}
