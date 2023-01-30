<?php

declare(strict_types=1);

namespace CCT\SDK\Infrastructure\Serialization\Caster;

use Attribute;
use CCT\SDK\Infrastructure\ValueObject\AbstractCollection;
use EventSauce\ObjectHydrator\ObjectMapper;
use EventSauce\ObjectHydrator\PropertyCaster;
use EventSauce\ObjectHydrator\PropertySerializer;

#[\Attribute(\Attribute::TARGET_PARAMETER | \Attribute::IS_REPEATABLE | \Attribute::TARGET_PROPERTY)]
final class CastToCollectionObject implements PropertyCaster, PropertySerializer
{
    /**
     * @param class-string $collectionClassName
     */
    public function __construct(
        private readonly string $collectionClassName
    ) {
    }

    public function cast(mixed $value, ObjectMapper $hydrator): mixed
    {
        assert(is_array($value));

        return $hydrator->hydrateObject($this->collectionClassName, ['items' => $value]);
    }

    public function serialize(mixed $value, ObjectMapper $hydrator): mixed
    {
        assert($value instanceof AbstractCollection);

        $data = $hydrator->serializeObject($value);

        return $data['items'] ?? [];
    }
}
