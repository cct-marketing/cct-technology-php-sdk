<?php

declare(strict_types=1);

namespace CCT\SDK\Infrastucture\ValueObject;

abstract class AbstractFloat extends AbstractValueObject implements SingleValueInterface
{
    public function __construct(public readonly float $value)
    {
        $this->guard($value);
    }

    abstract protected function guard(float $value): void;

    /**
     * @psalm-suppress UndefinedInterfaceMethod Static comparison will catch interface toInt does not exist error
     */
    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof static) {
            return false;
        }

        return $this->toFloat() === $valueObject->toFloat();
    }

    public function toFloat(): float
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

    public function toNative(): float
    {
        return $this->value;
    }
}
