<?php

declare(strict_types=1);

namespace CCT\SDK\Infrastructure\Serialization\Caster;

use Attribute;
use EventSauce\ObjectHydrator\ObjectMapper;
use EventSauce\ObjectHydrator\PropertyCaster;

#[Attribute(Attribute::TARGET_PARAMETER)]
class CastUnionToType implements PropertyCaster
{
    public function __construct(
        private array $typeToClassMap
    ) {
    }

    public function cast(mixed $value, ObjectMapper $hydrator): mixed
    {
        assert(is_array($value));

        $type = $value['_type'] ?? 'unknown';
        unset($value['_type']);
        $className = $this->typeToClassMap[$type] ?? null;

        if ($className === null) {
            throw new \LogicException("Unable to map type '$type' to class.");
        }

        return $hydrator->hydrateObject($className, $value);
    }
}
