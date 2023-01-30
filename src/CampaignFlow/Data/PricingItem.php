<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignFlow\Data;

use CCT\SDK\Infrastructure\Assert\Assertion;
use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;

final class PricingItem extends AbstractMulti
{
    public function __construct(public readonly PricingType $type, public readonly int $price)
    {
    }

    public function toArray(): array
    {
        return [
            'type' => $this->type->value,
            'price' => $this->price,
        ];
    }

    public static function fromArray(array $data): static
    {
        Assertion::allKeysExists($data, ['type', 'price'], self::errorPropertyPath());

        return new self(PricingType::from($data['type']), $data['price']);
    }
}
