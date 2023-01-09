<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Payload;

use CCT\SDK\Campaign\Data\AdContent\AdContent;
use CCT\SDK\Campaign\Data\Details\Details;
use CCT\SDK\Campaign\Data\Targeting\Targeting;
use CCT\SDK\CampaignFlow\Data\CampaignFlowUuid;
use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class CreateCampaign extends AbstractMulti
{
    public function __construct(
        public readonly CampaignFlowUuid $campaignFlowUuid,
        public readonly Details $details,
        public readonly AdContent $adContent,
        public readonly Targeting $targeting
    ) {
    }

    public function toArray(): array
    {
        return [
            'campaign_flow_uuid' => $this->campaignFlowUuid->toString(),
            'details' => $this->details->toArray(),
            'ad_content' => $this->adContent->toArray(),
            'targeting' => $this->targeting->toArray(),
        ];
    }

    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'campaign_flow_uuid', self::errorPropertyPath());
        Assertion::keyExists($data, 'details', self::errorPropertyPath());
        Assertion::keyExists($data, 'ad_content', self::errorPropertyPath());
        Assertion::keyExists($data, 'targeting', self::errorPropertyPath());

        return new self(
            CampaignFlowUuid::fromString($data['campaign_flow_uuid']),
            Details::fromArray($data['details']),
            AdContent::fromArray($data['ad_content']),
            Targeting::fromArray($data['targeting'])
        );
    }
}
