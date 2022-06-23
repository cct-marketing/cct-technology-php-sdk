<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ValueObject;

use Assert\Assertion;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;
use ReflectionClass;
use ReflectionException;
use Traversable;

abstract class AbstractEnum extends AbstractValueObject
{
    /**
     * @var array
     */
    protected static $cache = [];

    protected $value;

    /**
     * AbstractEnum constructor.
     */
    public function __construct($value)
    {
        $this->guard($value);
        $this->value = $value;
    }

    /**
     * @psalm-suppress UnsafeInstantiation
     */
    public static function __callStatic(string $name, $args)
    {
        return new static(self::values()[$name]);
    }

    /**
     * @return static
     * @psalm-suppress UnsafeInstantiation
     */
    public static function fromString(string $value)
    {
        return new static($value);
    }

    public static function values(): array
    {
        $class = static::class;
        if (!isset(self::$cache[$class])) {
            try {
                $reflected = new ReflectionClass($class);
                self::$cache[$class] = self::reindex($reflected->getConstants());
            } catch (ReflectionException $exception) {
                return [];
            }
        }

        return self::$cache[$class];
    }

    public function value()
    {
        return $this->value;
    }

    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $this->value === $valueObject->value();
    }

    private function guard($value): void
    {
        Assertion::inArray($value, static::values(), null, self::errorPropertyPath());
    }

    public function toString(): string
    {
        return (string) $this->value();
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * Returns a new collection with the keys reindexed.
     *
     * @param array|Traversable $collection collection to be reindexed
     */
    private static function reindex($collection): array
    {
        $result = [];
        foreach ($collection as $key => $value) {
            $result[$key] = $value;
        }

        return $result;
    }
}
