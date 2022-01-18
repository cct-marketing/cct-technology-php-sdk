<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\ItemPrice;

use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class ItemPriceCollection extends AbstractValueObject
{
    /**
     * @var ItemPrice[]
     */
    private $itemPrices;

    /**
     * @param array $itemPrices
     *
     * @return self
     */
    public static function fromArray(array $itemPrices): self
    {
        return new self(...array_map(static function (array $itemPrice) {
            return ItemPrice::fromArray($itemPrice);
        }, $itemPrices));
    }

    /**
     * @param ItemPrice ...$itemPrices
     *
     * @return self
     */
    public static function fromItems(ItemPrice ...$itemPrices): self
    {
        return new self(...$itemPrices);
    }

    /**
     * @param array $itemPrices
     *
     * @return self
     */
    public static function fromItemPrices(array $itemPrices): self
    {
        if (0 === count($itemPrices)) {
            return self::emptyList();
        }

        return new self(...$itemPrices);
    }

    /**
     * @return self
     */
    public static function emptyList(): self
    {
        return new self();
    }

    /**
     * Constructor.
     *
     * @param ItemPrice ...$itemPrices
     */
    private function __construct(ItemPrice ...$itemPrices)
    {
        $this->itemPrices = $itemPrices;
    }

    /**
     * @param ItemPrice $itemPrice
     *
     * @return self
     */
    public function push(ItemPrice $itemPrice): self
    {
        $copy = clone $this;
        $copy->itemPrices[] = $itemPrice;

        return $copy;
    }

    /**
     * @return self
     */
    public function pop(): self
    {
        $copy = clone $this;
        array_pop($copy->itemPrices);

        return $copy;
    }

    /**
     * @return ItemPrice|null
     */
    public function first(): ?ItemPrice
    {
        return $this->itemPrices[0] ?? null;
    }

    /**
     * @return ItemPrice|null
     */
    public function last(): ?ItemPrice
    {
        if (count($this->itemPrices) === 0) {
            return null;
        }

        return $this->itemPrices[count($this->itemPrices) - 1];
    }

    /**
     * @param ItemPrice $itemPrice
     *
     * @return bool
     */
    public function contains(ItemPrice $itemPrice): bool
    {
        foreach ($this->itemPrices as $existingItemPrice) {
            if ($existingItemPrice->equals($itemPrice)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return ItemPrice[]
     */
    public function itemPrices(): array
    {
        return $this->itemPrices;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_map(
            static function (ItemPrice $itemPrice) {
                return $itemPrice->toArray();
            },
            $this->itemPrices
        );
    }

    /**
     * @param ValueObjectInterface $other
     *
     * @return bool
     */
    public function equals(ValueObjectInterface $other): bool
    {
        if (!$other instanceof self) {
            return false;
        }

        return $this->toArray() === $other->toArray();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) json_encode($this->toArray());
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->itemPrices);
    }
}
