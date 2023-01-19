<?php

declare(strict_types=1);

namespace CCT\SDK\Infrastucture\ValueObject;

use CCT\SDK\Infrastucture\Serialization\Serializer;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
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

    public function toArray(): array
    {
        return Serializer::serialize($this);
    }

    /**
     * @psalm-suppress MoreSpecificReturnType
     * @psalm-suppress LessSpecificReturnStatement
     */
    public static function fromArray(array $data): static
    {
        return Serializer::deserialize(static::class, $data);
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public function toString(): string
    {
        return (string) json_encode($this->toArray(), JSON_THROW_ON_ERROR);
    }
}
