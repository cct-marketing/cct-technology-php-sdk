<?php

declare(strict_types=1);

namespace CCT\SDK\Client;

use CCT\SDK\Analytics\AnalyticsClient;
use CCT\SDK\Campaign\CampaignClient;
use CCT\SDK\CampaignFlow\CampaignFlowClient;
use CCT\SDK\Client\Options\Options;
use CCT\SDK\Customer\CustomerClient;
use CCT\SDK\MediaManagement\MediaClient;
use GuzzleHttp\Client as GuzzleClient;

final class Client
{
    public function __construct(private readonly Options $options, private readonly GuzzleClient $client)
    {
    }

    public function campaignClient(): CampaignClient
    {
        return new CampaignClient($this->options, $this->client);
    }

    public function mediaClient(): MediaClient
    {
        return new MediaClient($this->options, $this->client);
    }

    public function customerClient(): CustomerClient
    {
        return new CustomerClient($this->options, $this->client);
    }

    public function campaignFlowClient(): CampaignFlowClient
    {
        return new CampaignFlowClient($this->options, $this->client);
    }

    public function analyticsClient(): AnalyticsClient
    {
        return new AnalyticsClient($this->options, $this->client);
    }
}
