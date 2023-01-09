<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart;

use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractString;

final class Description extends AbstractString
{
    protected function guard(string $value): void
    {
        Assertion::maxLength($value, 60, self::errorPropertyPath());
    }

    public function notBlank(): bool
    {
        return trim($this->value) !== '';
    }
}
