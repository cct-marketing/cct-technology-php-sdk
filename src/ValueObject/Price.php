<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ValueObject;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class Price extends AbstractValueObject
{
    /**
     * @var int
     */
    private $amount;

    /**
     * @var string
     */
    private $currency;

    /**
     * The vat percentage
     *
     * @var float
     */
    private $vat;

    /**
     * @var int
     */
    private $amountExVat;

    /**
     * Price constructor.
     *
     * @param int    $amount
     * @param string $currency
     * @param float  $vat
     * @param int    $amountExVat
     */
    public function __construct(int $amount, string $currency, float $vat, int $amountExVat)
    {
        $this->amount = $amount;
        $this->currency = $currency;
        $this->vat = $vat;
        $this->amountExVat = $amountExVat;
    }

    /**
     * @param ValueObjectInterface | Price $valueObject
     *
     * @return bool
     */
    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $this->toArray() === $valueObject->toArray();
    }

    /**
     * Serialize object into an array or string
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'amount' => $this->amount,
            'currency' => $this->currency,
            'vat' => $this->vat,
            'amount_ex_vat' => $this->amountExVat,
        ];
    }

    /**
     * @param mixed $data
     *
     * @return self
     *
     * @throws AssertionFailedException
     */
    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'amount', null, self::errorPropertyPath());
        Assertion::keyExists($data, 'currency', null, self::errorPropertyPath());
        Assertion::keyExists($data, 'vat', null, self::errorPropertyPath());
        Assertion::keyExists($data, 'amount_ex_vat', null, self::errorPropertyPath());

        return new self(
            $data['amount'],
            $data['currency'],
            $data['vat'],
            $data['amount_ex_vat']
        );
    }

    /**
     * @return int
     */
    public function amount(): int
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function currency(): string
    {
        return $this->currency;
    }

    /**
     * @return float
     */
    public function vat(): float
    {
        return $this->vat;
    }

    /**
     * @return int
     */
    public function amountExVat(): int
    {
        return $this->amountExVat;
    }
}
