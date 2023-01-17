<?php

declare(strict_types=1);

namespace CCT\SDK\Analytics\Response;

use CCT\SDK\Campaign\Data\CampaignId;
use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class CampaignAnalytics extends AbstractMulti
{
    private function __construct(
        public readonly CampaignId $campaignId,
        public readonly string $orderCode,
        public readonly string $orderType,
        public readonly Customer $customer,
        public readonly Analytics $analytics,
        public readonly Period $period
    ) {
    }

    public function toArray(): array
    {
        return [
            'campaign_id' => $this->campaignId->toString(),
            'order_code' => $this->orderCode,
            'order_type' => $this->orderType,
            'customer' => $this->customer->toArray(),
            'period' => $this->period->toArray(),
            'analytics' => $this->analytics->toArray(),
        ];
    }

    public static function fromArray(array $data): static
    {
        Assertion::allKeysExists($data, ['campaign_id', 'order_code', 'order_type', 'customer', 'period', 'analytics'], self::errorPropertyPath());

        return new self(
            CampaignId::fromString($data['campaign_id']),
            $data['order_code'],
            $data['order_type'],
            Customer::fromArray($data['customer']),
            Analytics::fromArray($data['analytics']),
            Period::fromArray($data['period'])
        );
    }
}
