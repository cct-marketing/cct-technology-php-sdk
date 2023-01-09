<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart;

use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractString;

final class Heading extends AbstractString
{
    protected function guard(string $value): void
    {
        Assertion::maxLength($value, 50, self::errorPropertyPath());
    }

    public function notBlank(): bool
    {
        return trim($this->value) !== '';
    }
}
