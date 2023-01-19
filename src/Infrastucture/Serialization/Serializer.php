<?php

declare(strict_types=1);

namespace CCT\SDK\Infrastucture\Serialization;

use CCT\SDK\Exception\SerializationErrorException;
use CCT\SDK\Infrastucture\Assert\Exception\AssertionFailedException;
use EventSauce\ObjectHydrator\ObjectMapperUsingReflection;
use EventSauce\ObjectHydrator\UnableToHydrateObject;
use EventSauce\ObjectHydrator\UnableToSerializeObject;

final class Serializer
{
    private static ?ObjectMapperUsingReflection $mapper;

    /**
     * @param class-string $className
     */
    public static function deserialize(string $className, array $payload): object
    {
        try {
            return self::mapper()->hydrateObject($className, $payload);
        } catch (UnableToHydrateObject $exception) {
            $previous = $exception->getPrevious();
            if ($previous instanceof AssertionFailedException) {
                throw $previous;
            }

            throw SerializationErrorException::createFrom($exception);
        }
    }

    public static function serialize(object $object): mixed
    {
        return self::mapper()->serializeObject($object);
    }

    private static function mapper(): ObjectMapperUsingReflection
    {
        if (isset(self::$mapper)) {
            return self::$mapper;
        }

        try {
            return self::$mapper = new ObjectMapperUsingReflection();
        } catch (UnableToSerializeObject $exception) {
            throw SerializationErrorException::createFrom($exception);
        }
    }
}
