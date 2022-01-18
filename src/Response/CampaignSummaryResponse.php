<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\Response;

use CCT\SDK\CampaignWizard\ViewModel\Campaign\Campaign;

final class CampaignSummaryResponse
{
    private $campaign;

    private function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    public function toArray(): array
    {
        return $this->campaign->toArray();
    }

    public static function fromArray(array $data): self
    {
        return new self(Campaign::fromArray($data['campaign']));
    }
}
