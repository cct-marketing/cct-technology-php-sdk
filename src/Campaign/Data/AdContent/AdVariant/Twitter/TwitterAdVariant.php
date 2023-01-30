<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\AdVariant\Twitter;

use CCT\SDK\Campaign\Data\AdContent\Image\ImageCollection;
use CCT\SDK\Infrastructure\Assert\Assertion;
use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class TwitterAdVariant extends AbstractMulti
{
    public function __construct(public readonly string $text, public readonly ?ImageCollection $imageCollection = null)
    {
        $this->guard($text);
    }

    private function guard(string $text): void
    {
        Assertion::maxLength($text, 250, self::errorPropertyPath());
    }
}
