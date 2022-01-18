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

    /**
     * @var mixed
     */
    protected $value;

    /**
     * AbstractEnum constructor.
     *
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->guard($value);
        $this->value = $value;
    }

    /**
     * @param string $name
     * @param mixed  $args
     *
     * @return AbstractEnum
     */
    public static function __callStatic(string $name, $args)
    {
        return new static(self::values()[$name]);
    }

    /**
     * @param string $value
     *
     * @return static
     */
    public static function fromString(string $value)
    {
        return new static($value);
    }

    /**
     * @return array
     */
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

    /**
     * @return mixed
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * @param ValueObjectInterface $valueObject
     *
     * @return bool
     */
    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $this->value === $valueObject->value();
    }

    /**
     * @param mixed $value
     */
    private function guard($value): void
    {
        Assertion::inArray($value, static::values(), null, self::errorPropertyPath());
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return (string) $this->value();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * Returns a new collection with the keys reindexed.
     *
     * @param array|Traversable $collection collection to be reindexed
     *
     * @return array
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
