<?php

declare(strict_types=1);

namespace CCT\SDK\Infrastucture\ValueObject;

use CCT\SDK\Infrastucture\Assert\Assertion;

class AbstractBool extends AbstractValueObject implements SingleValueInterface
{
    public static function fromBool(bool $value): static
    {
        return new static($value);
    }

    public static function fromMixed(mixed $value): static
    {
        Assertion::inArray($value, [true, false, 'true', 'false', '0', '1', 0, 1], static::errorPropertyPath());

        return new static(in_array($value, [true, 1, 'true', '1'], true));
    }

    public function __construct(public readonly bool $value)
    {
    }

    public function toBool(): bool
    {
        return $this->value;
    }

    /**
     * @psalm-suppress UndefinedInterfaceMethod Static comparison will catch interface toBool does not exist error
     */
    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof static) {
            return false;
        }

        return $this->toBool() === $valueObject->toBool();
    }

    public function toString(): string
    {
        return $this->value ? 'true' : 'false';
    }

    public function toNative(): bool
    {
        return $this->value;
    }
}
