<?php

declare(strict_types=1);

namespace CCT\SDK\Infrastucture\ValueObject;

abstract class AbstractString extends AbstractValueObject
{
    public function __construct(public readonly string $value)
    {
        $this->guard($value);
    }

    abstract protected function guard(string $value): void;

    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof static) {
            return false;
        }

        return $this->toString() === $valueObject->toString();
    }

    public function toString(): string
    {
        return $this->value;
    }

    public static function fromString(string $data): static
    {
        return new static($data);
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
