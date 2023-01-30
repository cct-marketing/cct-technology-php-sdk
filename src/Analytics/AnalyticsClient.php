<?php

declare(strict_types=1);

namespace CCT\SDK\Analytics;

use CCT\SDK\Analytics\Response\CampaignAnalytics;
use CCT\SDK\Campaign\Data\CampaignId;
use CCT\SDK\Client\AbstractServiceClient;
use CCT\SDK\Customer\Data\CustomerId;
use CCT\SDK\Infrastucture\ValueObject\AbstractUrlOption;
use GuzzleHttp\Psr7\Request;

final class AnalyticsClient extends AbstractServiceClient
{
    public function campaignAnalytics(CustomerId $customerId, CampaignId $campaignId): ?CampaignAnalytics
    {
        $request = new Request(
            'GET',
            sprintf('api-v2/customers/%s/campaigns/%s/analytics', $customerId->toString(), $campaignId->toString())
        );

        $data = $this->sendJsonRequest($request, 200);

        if (count($data) === 0) {
            return null;
        }

        return CampaignAnalytics::fromArray($data[0]);
    }

    public function host(): AbstractUrlOption
    {
        return $this->options->analyticsHost;
    }
}
