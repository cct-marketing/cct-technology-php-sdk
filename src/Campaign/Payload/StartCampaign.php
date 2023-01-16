<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Payload;

use CCT\SDK\CampaignFlow\Data\CampaignFlowId;
use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class StartCampaign extends AbstractMulti
{
    public function __construct(
        public readonly CampaignFlowId $campaignFlowId
    ) {
    }

    public function toArray(): array
    {
        return [
            'campaign_flow_uuid' => $this->campaignFlowId->toString(),
        ];
    }

    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'campaign_flow_uuid', self::errorPropertyPath());

        return new self(
            CampaignFlowId::fromString($data['campaign_flow_uuid']),
        );
    }
}
