<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Response;

use CCT\SDK\Campaign\Data\CampaignId;
use CCT\SDK\Infrastucture\Assert\Assertion;

final class CommonMutateResponse
{
    public function __construct(public readonly CampaignId $campaignId)
    {
    }

    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'uuid', 'campaign_creation_response');

        return new self(CampaignId::fromString($data['uuid']));
    }
}
