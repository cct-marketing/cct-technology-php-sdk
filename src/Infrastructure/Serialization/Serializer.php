<?php

declare(strict_types=1);

namespace CCT\SDK\Infrastructure\Serialization;

use CCT\SDK\Exception\SerializationErrorException;
use CCT\SDK\Infrastructure\Assert\Exception\AssertionFailedException;
use CCT\SDK\Infrastructure\Serialization\Mapper\OptimizedMapper;
use EventSauce\ObjectHydrator\ObjectMapper;
use EventSauce\ObjectHydrator\UnableToHydrateObject;
use EventSauce\ObjectHydrator\UnableToSerializeObject;

final class Serializer
{
    private static ?ObjectMapper $mapper;

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

    private static function mapper(): ObjectMapper
    {
        if (isset(self::$mapper)) {
            return self::$mapper;
        }

        try {
            return self::$mapper = new OptimizedMapper();
        } catch (UnableToSerializeObject $exception) {
            throw SerializationErrorException::createFrom($exception);
        }
    }
}
