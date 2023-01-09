<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Payload;

use CCT\SDK\CampaignFlow\Data\CampaignFlowUuid;
use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class StartCampaign extends AbstractMulti
{
    public function __construct(
        public readonly CampaignFlowUuid $campaignFlowUuid
    ) {
    }

    public function toArray(): array
    {
        return [
            'campaign_flow_uuid' => $this->campaignFlowUuid->toString(),
        ];
    }

    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'campaign_flow_uuid', self::errorPropertyPath());

        return new self(
            CampaignFlowUuid::fromString($data['campaign_flow_uuid']),
        );
    }
}
