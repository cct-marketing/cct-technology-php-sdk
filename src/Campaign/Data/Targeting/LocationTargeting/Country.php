<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Targeting\LocationTargeting;

use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class Country extends AbstractMulti
{
    public function __construct(public readonly string $name, public readonly string $code)
    {
        $this->guard($code);
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'code' => $this->code,
        ];
    }

    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'name', self::errorPropertyPath());
        Assertion::keyExists($data, 'code', self::errorPropertyPath());

        return new self($data['name'], $data['code']);
    }

    public function guard(string $code)
    {
        Assertion::maxLength($code, 2, self::errorPropertyPath());
        Assertion::minLength($code, 2, self::errorPropertyPath());
    }
}
