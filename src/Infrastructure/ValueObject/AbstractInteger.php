<?php

declare(strict_types=1);

namespace CCT\SDK\Infrastructure\ValueObject;

abstract class AbstractInteger extends AbstractValueObject implements SingleValueInterface
{
    public function __construct(public readonly int $value)
    {
        $this->guard($value);
    }

    abstract protected function guard(int $value): void;

    /**
     * @psalm-suppress UndefinedInterfaceMethod Static comparison will catch interface toInt does not exist error
     */
    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof static) {
            return false;
        }

        return $this->toInt() === $valueObject->toInt();
    }

    public function toInt(): int
    {
        return $this->value;
    }

    public static function fromInt(int $data): static
    {
        return new static($data);
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public function toString(): string
    {
        return (string) $this->value;
    }

    public function toNative(): int
    {
        return $this->value;
    }
}
