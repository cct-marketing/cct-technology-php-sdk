<?php

declare(strict_types=1);

namespace CCT\SDK\Infrastructure\Assert;

use CCT\SDK\Infrastructure\ValueObject\ValueObjectInterface;
use CCT\SDK\Infrastructure\Assert\BeberleiAssertion as AssertionLib;

final class Assertion
{
    public static function keyExists(array $data, string $key, ?string $propertyPath): void
    {
        AssertionLib::keyExists($data, $key, null, $propertyPath);
    }

    public static function allKeysExists(array $data, array $keys, ?string $propertyPath): void
    {
        foreach ($keys as $key) {
            self::keyExists($data, $key, $propertyPath);
        }
    }

    public static function string(mixed $value, ?string $propertyPath): void
    {
        AssertionLib::string($value, null, $propertyPath);
    }

    /**
     * @psalm-assert !empty $value
     */
    public static function notEmpty(mixed $value, ?string $propertyPath): void
    {
        AssertionLib::notEmpty($value, null, $propertyPath);
    }

    /**
     * @psalm-assert !null $value
     */
    public static function notNull(mixed $value, ?string $propertyPath): void
    {
        AssertionLib::notNull($value, null, $propertyPath);
    }

    public static function url(mixed $value, ?string $propertyPath): void
    {
        AssertionLib::url($value, null, $propertyPath);
    }

    public static function maxLength(mixed $value, int $maxLength, ?string $propertyPath): void
    {
        AssertionLib::maxLength($value, $maxLength, null, $propertyPath);
    }

    public static function date(string $value, string $format, string $propertyPath): void
    {
        AssertionLib::date($value, $format, null, $propertyPath);
    }

    /**
     * @psalm-template ExpectedType of object
     *
     * @psalm-param class-string<ExpectedType> $className
     *
     * @psalm-assert ExpectedType $value
     */
    public static function isInstanceOf(mixed $value, string $className, string $propertyPath): void
    {
        AssertionLib::isInstanceOf($value, $className, null, $propertyPath);
    }

    public static function inArray(mixed $value, array $choices, string $propertyPath): void
    {
        AssertionLib::inArray($value, $choices, null, $propertyPath);
    }

    public static function minLength(mixed $value, int $minLength, ?string $propertyPath): void
    {
        AssertionLib::minLength($value, $minLength, null, $propertyPath);
    }

    public static function numeric(mixed $value, ?string $propertyPath): void
    {
        AssertionLib::numeric($value, null, $propertyPath);
    }

    public static function between(mixed $value, int $lowerLimit, int $upperLimit, string $propertyPath): void
    {
        AssertionLib::between($value, $lowerLimit, $upperLimit, null, $propertyPath);
    }

    public static function nullOrMax(mixed $value, int $maxValue, string $propertyPath): void
    {
        AssertionLib::nullOrMax($value, $maxValue, $propertyPath);
    }

    public static function nullOrChoice(mixed $value, array $choices, string $propertyPath): void
    {
        AssertionLib::nullOrChoice($value, $choices, $propertyPath);
    }

    public static function nullOrUuid(?string $value, string $propertyPath): void
    {
        AssertionLib::nullOrUuid($value, $propertyPath);
    }

    public static function isArray(mixed $value, string $propertyPath): void
    {
        AssertionLib::nullOrUuid($value, null, $propertyPath);
    }

    public static function minCount(array $value, int $minCount, string $propertyPath): void
    {
        AssertionLib::minCount($value, $minCount, null, $propertyPath);
    }

    public static function maxCount(array $value, int $maxCount, string $propertyPath): void
    {
        AssertionLib::maxCount($value, $maxCount, null, $propertyPath);
    }

    public static function email(string $value, string $propertyPath): void
    {
        AssertionLib::email($value, null, $propertyPath);
    }

    public static function noDuplicates(array $value, string $propertyPath): void
    {
        $value = self::removeEmpties($value);

        AssertionLib::same(
            count($value),
            count(array_unique($value)),
            'Array should not contain duplicates.',
            $propertyPath
        );
    }

    private static function removeEmpties(array $values): array
    {
        $withOutEmpty = [];
        foreach ($values as $value) {
            if ($value instanceof ValueObjectInterface) {
                $value = $value->toString();
            }
            if ($value === '' && !in_array('', $withOutEmpty, true)) {
                continue;
            }

            $withOutEmpty[] = $value;
        }

        return $withOutEmpty;
    }

    public static function isResource(mixed $fileResource): void
    {
        AssertionLib::isResource($fileResource);
    }
}
