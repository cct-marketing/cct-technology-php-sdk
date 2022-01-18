<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues;

use Assert\Assertion;
use Assert\AssertionFailedException;
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

    /**
     * Product constructor.
     *
     * @param string      $name
     * @param Price|null  $additionalSpending
     * @param string|null $mapTo
     *
     * @throws AssertionFailedException
     */
    public function __construct(string $name, ?Price $additionalSpending, ?string $mapTo = null)
    {
        $this->guard($name, $mapTo);
        $this->name = $name;
        $this->additionalSpending = $additionalSpending;
        $this->mapTo = $mapTo;
    }

    /**
     * @param ValueObjectInterface|CampaignTitle $product
     *
     * @return bool
     */
    public function equals(ValueObjectInterface $product): bool
    {
        if (!$product instanceof self) {
            return false;
        }

        return $this->toArray() === $product->toArray();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Price
     */
    public function getAdditionalSpending(): ?Price
    {
        return $this->additionalSpending;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'additional_spending' => $this->additionalSpending === null ? null : $this->additionalSpending->toArray(),
            'map_to' => $this->mapTo,
        ];
    }

    /**
     * @param array $data
     *
     * @return self
     *
     * @throws AssertionFailedException
     */
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

    /**
     * @param string      $name
     * @param string|null $mapTo
     *
     * @throws AssertionFailedException
     */
    private function guard(string $name, ?string $mapTo): void
    {
        Assertion::maxLength($name, 120, null, self::errorPropertyPath());
        Assertion::minLength($name, 3, null, self::errorPropertyPath());
        if (null !== $mapTo) {
            Assertion::minLength($mapTo, 1, null, self::errorPropertyPath());
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
