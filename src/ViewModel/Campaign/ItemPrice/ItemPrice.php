<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\ItemPrice;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ValueObject\Price;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class ItemPrice extends AbstractValueObject
{
    public const MEDIA_SPENDING_TYPE = 'media_spending';
    public const ADDITIONAL_MEDIA_SPENDING_TYPE = 'additional_media_spending';
    public const SETUP_FEE_TYPE = 'setup_fee';
    public const CONTENT_PRODUCTION_FEE_TYPE = 'content_production_fee';
    public const ADMINISTRATION_FEE_TYPE = 'administration_fee';

    /**
     * @var string
     */
    private $priceType;

    /**
     * @var string
     */
    private $referenceName;

    /**
     * @var Price
     */
    private $price;

    /**
     * @throws AssertionFailedException
     */
    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'price_type', null, self::errorPropertyPath());
        Assertion::keyExists($data, 'reference_name', null, self::errorPropertyPath());
        Assertion::keyExists($data, 'price', null, self::errorPropertyPath());

        return new self(
            $data['price_type'],
            $data['reference_name'],
            Price::fromArray($data['price'])
        );
    }

    /**
     * ItemPrice factory method.
     *
     * @return ItemPrice
     *
     * @throws AssertionFailedException
     */
    public static function create(string $priceType, string $referenceName, Price $price): self
    {
        return new self($priceType, $referenceName, $price);
    }

    /**
     * @return static
     *
     * @throws AssertionFailedException
     */
    public static function createMediaSpending(string $referenceName, Price $price): self
    {
        return new self(self::MEDIA_SPENDING_TYPE, $referenceName, $price);
    }

    /**
     * @return static
     *
     * @throws AssertionFailedException
     */
    public static function createAdditionalMediaSpending(string $referenceName, Price $price): self
    {
        return new self(self::ADDITIONAL_MEDIA_SPENDING_TYPE, $referenceName, $price);
    }

    /**
     * @return static
     *
     * @throws AssertionFailedException
     */
    public static function createSetupFee(string $referenceName, Price $price): self
    {
        return new self(self::SETUP_FEE_TYPE, $referenceName, $price);
    }

    /**
     * @return static
     *
     * @throws AssertionFailedException
     */
    public static function createContentProductionFee(string $referenceName, Price $price): self
    {
        return new self(self::CONTENT_PRODUCTION_FEE_TYPE, $referenceName, $price);
    }

    /**
     * @return static
     *
     * @throws AssertionFailedException
     */
    public static function createAdministrationFee(string $referenceName, Price $price): self
    {
        return new self(self::ADMINISTRATION_FEE_TYPE, $referenceName, $price);
    }

    /**
     * ItemPrice constructor.
     *
     * @throws AssertionFailedException
     */
    private function __construct(string $priceType, string $referenceName, Price $price)
    {
        $this->guard($priceType);
        $this->priceType = $priceType;
        $this->referenceName = $referenceName;
        $this->price = $price;
    }

    public function toArray(): array
    {
        return [
            'price_type' => $this->priceType,
            'reference_name' => $this->referenceName,
            'price' => $this->price->toArray(),
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

    public function priceType(): string
    {
        return $this->priceType;
    }

    public function referenceName(): string
    {
        return $this->referenceName;
    }

    public function price(): Price
    {
        return $this->price;
    }

    /**
     * @throws AssertionFailedException
     */
    public function guard(string $priceType): void
    {
        Assertion::inArray(
            $priceType,
            [
                self::MEDIA_SPENDING_TYPE,
                self::ADDITIONAL_MEDIA_SPENDING_TYPE,
                self::ADMINISTRATION_FEE_TYPE,
                self::CONTENT_PRODUCTION_FEE_TYPE,
                self::SETUP_FEE_TYPE,
            ],
            null,
            self::errorPropertyPath()
        );
    }
}
