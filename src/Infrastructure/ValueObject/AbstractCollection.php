<?php

declare(strict_types=1);

namespace CCT\SDK\Infrastructure\ValueObject;

use CCT\SDK\Infrastructure\Assert\Assertion;
use CCT\SDK\Infrastructure\Serialization\Serializer;
use EventSauce\ObjectHydrator\DoNotSerialize;
use IteratorAggregate;

/**
 * @template-implements IteratorAggregate<int, ValueObjectInterface>
 */
abstract class AbstractCollection extends AbstractValueObject implements \IteratorAggregate
{
    public function __construct(
        protected array $items
    ) {
        $this->guard($this->items);
    }

    #[DoNotSerialize]
    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->items);
    }

    /**
     * @psalm-suppress UndefinedInterfaceMethod Static comparison will catch interface toArray does not exist error
     */
    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof static) {
            return false;
        }

        return $valueObject->toArray() === $this->toArray();
    }

    /**
     * @return class-string
     */
    abstract public static function itemClassName(): string;

    #[DoNotSerialize]
    public function toArray(): array
    {
        $data = Serializer::serialize($this);

        return $data['items'] ?? [];
    }

    /**
     * @psalm-suppress MoreSpecificReturnType
     * @psalm-suppress LessSpecificReturnStatement
     */
    public static function fromArray(array $data): static
    {
        if (0 === count($data)) {
            return static::emptyList();
        }

        return Serializer::deserialize(static::class, ['items' => $data]);
    }

    protected function isInstanceOf(ValueObjectInterface $item): void
    {
        Assertion::isInstanceOf($item, static::itemClassName(), static::errorPropertyPath());
    }

    public static function fromItems(ValueObjectInterface ...$items): static
    {
        return new static($items);
    }

    public static function emptyList(): static
    {
        return new static([]);
    }

    public function push(ValueObjectInterface $item): static
    {
        $this->isInstanceOf($item);
        $copy = clone $this;
        $copy->items[] = $item;

        return $copy;
    }

    #[DoNotSerialize]
    public function pop(): static
    {
        $copy = clone $this;
        array_pop($copy->items);

        return $copy;
    }

    #[DoNotSerialize]
    public function first(): ?ValueObjectInterface
    {
        return $this->items[0] ?? null;
    }

    #[DoNotSerialize]
    public function last(): ?ValueObjectInterface
    {
        if (count($this->items) === 0) {
            return null;
        }

        return $this->items[count($this->items) - 1];
    }

    public function contains(ValueObjectInterface $item): bool
    {
        foreach ($this->items as $existingItem) {
            if ($existingItem->equals($item)) {
                return true;
            }
        }

        return false;
    }

    #[DoNotSerialize]
    public function count(): int
    {
        return count($this->items);
    }

    #[DoNotSerialize]
    public function __toString(): string
    {
        return $this->toString();
    }

    public function items(): array
    {
        return $this->items;
    }

    #[DoNotSerialize]
    public function toString(): string
    {
        return (string) json_encode($this->toArray(), JSON_THROW_ON_ERROR);
    }

    protected function guard(array $items): void
    {
        foreach ($items as $item) {
            $this->isInstanceOf($item);
        }
    }
}
