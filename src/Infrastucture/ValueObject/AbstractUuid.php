<?php

declare(strict_types=1);

namespace CCT\SDK\Infrastucture\ValueObject;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

abstract class AbstractUuid extends AbstractValueObject
{
    public function __construct(public readonly UuidInterface $value)
    {
    }

    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof static) {
            return false;
        }

        return $this->toString() === $valueObject->toString();
    }

    public function toString(): string
    {
        return $this->value->toString();
    }

    public static function fromString(string $uuid): static
    {
        return new static(Uuid::fromString($uuid));
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
