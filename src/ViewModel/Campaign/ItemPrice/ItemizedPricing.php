<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\ItemPrice;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class ItemizedPricing extends AbstractValueObject
{
    /**
     * @var ItemPriceCollection
     */
    private $itemPriceCollection;

    /**
     * @throws AssertionFailedException
     */
    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'priceable_items', '', self::errorPropertyPath());

        return new self(ItemPriceCollection::fromArray($data['priceable_items']));
    }

    public function toArray(): array
    {
        return [
            'priceable_items' => $this->itemPriceCollection->toArray(),
        ];
    }

    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $this->toArray() === $valueObject->toArray();
    }

    public function __toString(): string
    {
        return (string) json_encode($this->toArray());
    }

    public static function create(ItemPriceCollection $priceableItems): self
    {
        return new self($priceableItems);
    }

    /**
     * ItemizedPricing constructor.
     */
    private function __construct(ItemPriceCollection $priceableItems)
    {
        $this->itemPriceCollection = $priceableItems;
    }

    public function getItemPriceCollection(): ItemPriceCollection
    {
        return $this->itemPriceCollection;
    }
}