<?php

declare(strict_types=1);

namespace CCT\SDK\Infrastructure\Serialization\Caster;

use Attribute;
use EventSauce\ObjectHydrator\ObjectMapper;
use EventSauce\ObjectHydrator\PropertyCaster;
use EventSauce\ObjectHydrator\PropertySerializer;

#[Attribute(Attribute::TARGET_PARAMETER | Attribute::TARGET_PROPERTY | Attribute::TARGET_METHOD)]
class CastListUnionToType implements PropertyCaster, PropertySerializer
{
    public function __construct(
        private array $typeToClassMap
    ) {
    }

    public function cast(mixed $value, ObjectMapper $hydrator): mixed
    {
        assert(is_array($value));

        foreach ($value as $i => $item) {
            $type = $item['_type'] ?? $item['type'] ?? 'no type set';

            $className = $this->typeToClassMap[$type] ?? null;

            if ($className === null) {
                throw new \LogicException("Unable to map type '$type' to class.");
            }

            $value[$i] = $hydrator->hydrateObject($className, $item);
        }

        return $value;
    }

    public function serialize(mixed $value, ObjectMapper $hydrator): mixed
    {
        assert(is_array($value));

        $newValue = [];
        foreach ($value as $item) {
            if (is_object($item)) {
                $type = array_search(get_class($item), $this->typeToClassMap);

                if (false === $type) {
                    throw new \LogicException(sprintf('Class in "%s" is not a valid object', get_class($item)));
                }

                $data = $hydrator->serializeObject($item);
                $data['_type'] = $type;
                $newValue[] = $data;
            }
        }

        return $newValue;
    }
}
