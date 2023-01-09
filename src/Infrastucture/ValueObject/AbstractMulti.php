<?php

declare(strict_types=1);

namespace CCT\SDK\Infrastucture\ValueObject;

abstract class AbstractMulti extends AbstractValueObject
{
    /**
     * @psalm-suppress UndefinedInterfaceMethod Static comparison will catch interface toArray does not exist error
     */
    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof static) {
            return false;
        }

        return $valueObject->toArray() === $this->toArray();
    }

    abstract public function toArray(): array;

    abstract public static function fromArray(array $data): static;

    public function __toString(): string
    {
        return $this->toString();
    }

    public function toString(): string
    {
        return (string) json_encode($this->toArray(), JSON_THROW_ON_ERROR);
    }
}
