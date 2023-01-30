<?php

declare(strict_types=1);

namespace CCT\SDK\Infrastructure\ValueObject;

abstract class AbstractValueObject implements ValueObjectInterface
{
    abstract public function equals(ValueObjectInterface $valueObject): bool;

    public static function errorPropertyPath(): string
    {
        try {
            $shortName = (new \ReflectionClass(static::class))->getShortName();
        } catch (\ReflectionException $exception) {
            $shortName = substr((string) strrchr(__CLASS__, '\\'), 1);
        }

        $shortNameUnderScored = preg_replace('/([A-Z])/', '_$1', $shortName);

        return strtolower($shortNameUnderScored ?? '');
    }

    abstract public function toString(): string;
}
