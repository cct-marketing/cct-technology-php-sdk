<?php

declare(strict_types=1);

namespace CCT\SDK\Infrastucture\Serialization\Caster;

use Attribute;
use EventSauce\ObjectHydrator\ObjectMapper;
use EventSauce\ObjectHydrator\PropertyCaster;
use EventSauce\ObjectHydrator\PropertySerializer;

#[\Attribute(\Attribute::TARGET_PARAMETER | \Attribute::IS_REPEATABLE | \Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD)]
final class CastListToSingleValueObject implements PropertyCaster, PropertySerializer
{
    /**
     * @param class-string $className
     */
    public function __construct(private readonly string $className)
    {
    }

    public function cast(mixed $value, ObjectMapper $hydrator): mixed
    {
        assert(is_array($value), 'value is expected to be an array');

        return $this->castToObjectType($value, $hydrator);
    }

    private function castToObjectType(array $value, ObjectMapper $hydrator): array
    {
        if (method_exists($this->className, 'itemClassName')) {
            $className = $this->className::itemClassName();
        } else {
            $className = $this->className;
        }

        foreach ($value as $i => $item) {
            $value[$i] = $hydrator->hydrateObject($className, ['value' => $item]);
        }

        return $value;
    }

    public function serialize(mixed $value, ObjectMapper $hydrator): mixed
    {
        assert(is_array($value), 'value should be an array');

        foreach ($value as $i => $item) {
            $value[$i] = $item->toNative();
        }

        return $value;
    }
}
