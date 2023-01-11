<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignFlow\Data;

use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class Settings extends AbstractMulti
{
    public function __construct(public readonly Currency $currency, public readonly Vat $vat, public readonly ExcludeVat $priceExVat)
    {
    }

    public function toArray(): array
    {
        return [
            'currency' => $this->currency->toString(),
            'vat' => $this->vat->toFloat(),
            'exclude_vat' => $this->priceExVat->toArray(),
        ];
    }

    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'currency', self::errorPropertyPath());
        Assertion::keyExists($data, 'vat', self::errorPropertyPath());
        Assertion::keyExists($data, 'exclude_vat', self::errorPropertyPath());

        return new self(
            Currency::fromString($data['currency']),
            Vat::fromInt($data['vat']),
            ExcludeVat::fromArray($data['exclude_vat'])
        );
    }
}
