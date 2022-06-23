<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues;

use Assert\Assertion;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ValueObject\Price;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class Product extends AbstractValueObject
{
    /**
     * @var string;
     */
    private $name;

    /**
     * @var Price | null
     */
    private $additionalSpending;

    /**
     * @var string|null
     */
    private $mapTo;

    public function __construct(string $name, ?Price $additionalSpending, ?string $mapTo = null)
    {
        $this->guard($name, $mapTo);
        $this->name = $name;
        $this->additionalSpending = $additionalSpending;
        $this->mapTo = $mapTo;
    }

    public function equals(ValueObjectInterface $product): bool
    {
        if (!$product instanceof self) {
            return false;
        }

        return $this->toArray() === $product->toArray();
    }

    public function name(): string
    {
        return $this->name;
    }

    public function additionalSpending(): ?Price
    {
        return $this->additionalSpending;
    }

    public function mapTo(): ?string
    {
        return $this->mapTo;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'additional_spending' => $this->additionalSpending === null ? null : $this->additionalSpending->toArray(),
            'map_to' => $this->mapTo,
        ];
    }

    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'name', null, 'product');
        Assertion::keyExists($data, 'additional_spending', null, 'product');

        return new self(
            $data['name'],
            $data['additional_spending'] === null ? null : Price::fromArray($data['additional_spending']),
            $data['map_to'] ?? null
        );
    }

    private function guard(string $name, ?string $mapTo): void
    {
        Assertion::maxLength($name, 120, null, self::errorPropertyPath());
        Assertion::minLength($name, 3, null, self::errorPropertyPath());
        if (null !== $mapTo) {
            Assertion::minLength($mapTo, 1, null, self::errorPropertyPath());
        }
    }

    public function __toString()
    {
        return $this->name;
    }
}
