<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart;

use CCT\SDK\Infrastructure\Assert\Assertion;
use CCT\SDK\Infrastructure\ValueObject\AbstractString;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class Text extends AbstractString
{
    protected function guard(string $value): void
    {
        Assertion::maxLength($value, 200, self::errorPropertyPath());
    }

    public function notBlank(): bool
    {
        return trim($this->value) !== '';
    }
}
