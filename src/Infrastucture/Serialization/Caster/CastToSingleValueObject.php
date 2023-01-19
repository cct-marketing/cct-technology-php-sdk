<?php

declare(strict_types=1);

namespace CCT\SDK\Infrastucture\Serialization\Caster;

use Attribute;
use CCT\SDK\Infrastucture\ValueObject\SingleValueInterface;
use EventSauce\ObjectHydrator\ObjectMapper;
use EventSauce\ObjectHydrator\PropertyCaster;
use EventSauce\ObjectHydrator\PropertySerializer;

#[\Attribute(\Attribute::TARGET_PARAMETER | \Attribute::IS_REPEATABLE | \Attribute::TARGET_PROPERTY)]
final class CastToSingleValueObject implements PropertyCaster, PropertySerializer
{
    /**
     * @param class-string $className
     */
    public function __construct(
        private readonly string $className
    ) {
    }

    public function cast(mixed $value, ObjectMapper $hydrator): mixed
    {
        return $hydrator->hydrateObject($this->className, ['value' => $value]);
    }

    public function serialize(mixed $value, ObjectMapper $hydrator): mixed
    {
        assert($value instanceof SingleValueInterface);

        return $value->toNative();
    }
}
