<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Metadata\Branding;

use CCT\SDK\Infrastructure\Assert\Assertion;
use CCT\SDK\Infrastructure\ValueObject\AbstractString;

final class BrandingKey extends AbstractString
{
    private const PATTERN = '/^[a-z][a-z0-9]*(_[a-z0-9]+)*$/';

    protected function guard(string $value): void
    {
        Assertion::notEmpty($value, self::errorPropertyPath());

        if (preg_match(self::PATTERN, $value) !== 1) {
            throw new \InvalidArgumentException(sprintf(
                'Branding key "%s" must be lowercase snake_case with no spaces.',
                $value
            ));
        }
    }
}
