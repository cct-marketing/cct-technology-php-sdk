<?php

declare(strict_types=1);

namespace CCT\SDK\Infrastucture\ValueObject;

use CCT\SDK\Infrastucture\Assert\Assertion;

abstract class AbstractCollection extends AbstractValueObject
{
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

    public function __construct(protected array $items)
    {
        $this->guard($this->items);
    }

    /**
     * @return class-string
     */
    abstract protected static function itemClassName(): string;

    public static function fromArray(array $data): static
    {
        $itemClassName = static::itemClassName();

        return new static(array_map(static function (array $itemData) use ($itemClassName) {
            return $itemClassName::fromArray($itemData);
        }, $data));
    }

    public function toArray(): array
    {
        return array_map(static function (AbstractMulti $image) {
            return $image->toArray();
        }, $this->items);
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

    public function pop(): static
    {
        $copy = clone $this;
        array_pop($copy->items);

        return $copy;
    }

    public function first(): ?ValueObjectInterface
    {
        return $this->items[0] ?? null;
    }

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

    public function count(): int
    {
        return count($this->items);
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public function items(): array
    {
        return $this->items;
    }

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
