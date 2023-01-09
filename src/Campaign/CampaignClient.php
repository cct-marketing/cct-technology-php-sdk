<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign;

use CCT\SDK\Campaign\Data\CampaignUuid;
use CCT\SDK\Campaign\Payload\CreateCampaign;
use CCT\SDK\Campaign\Payload\SaveCampaign;
use CCT\SDK\Campaign\Payload\StartCampaign;
use CCT\SDK\Campaign\Response\CommonMutateResponse;
use CCT\SDK\Client\Options\Options;
use CCT\SDK\Customer\Data\CustomerId;
use CCT\SDK\Exception\InvalidStatusCodeException;
use GuzzleHttp\Client;

final class CampaignClient
{
    public function __construct(private readonly Options $options, private readonly Client $client)
    {
    }

    public function startCampaign(StartCampaign $startCampaign, CustomerId $customerId): CommonMutateResponse
    {
        $host = $this->options->campaignWizardHost;

        $response = $this->client->post(
            sprintf('%s/customers/%s/campaigns/start', $host->toString(), $customerId->toString()),
            [
                'body' => json_encode($startCampaign->toArray()),
            ]
        );

        if (201 !== $response->getStatusCode()) {
            throw InvalidStatusCodeException::create(201, $response->getStatusCode(), $response->getBody()->getContents());
        }

        return CommonMutateResponse::createFromResponse($response);
    }

    public function saveCampaign(SaveCampaign $saveCampaign, CustomerId $customerId, CampaignUuid $campaignUuid): CommonMutateResponse
    {
        $host = $this->options->campaignWizardHost;

        $response = $this->client->patch(
            sprintf('%s/customers/%s/campaigns/%s', $host->toString(), $customerId->toString(), $campaignUuid->toString()),
            [
                'body' => json_encode($saveCampaign->toArray()),
            ]
        );

        if (200 !== $response->getStatusCode()) {
            throw InvalidStatusCodeException::create(200, $response->getStatusCode(), $response->getBody()->getContents());
        }

        return CommonMutateResponse::createFromResponse($response);
    }

    public function placeCampaign(CustomerId $customerId, CampaignUuid $campaignUuid): CommonMutateResponse
    {
        $host = $this->options->campaignWizardHost;

        $response = $this->client->post(
            sprintf('%s/customers/%s/campaigns/%s/place', $host->toString(), $customerId->toString(), $campaignUuid->toString())
        );

        if (202 !== $response->getStatusCode()) {
            throw InvalidStatusCodeException::create(202, $response->getStatusCode(), $response->getBody()->getContents());
        }

        return CommonMutateResponse::createFromResponse($response);
    }

    public function createCampaign(CreateCampaign $campaign, CustomerId $customerId): CommonMutateResponse
    {
        $host = $this->options->campaignWizardHost;

        $response = $this->client->post(
            sprintf('%s/customers/%s/campaigns', $host->toString(), $customerId->toString()),
            [
                'body' => json_encode($campaign->toArray()),
            ]
        );

        if (202 !== $response->getStatusCode()) {
            throw InvalidStatusCodeException::create(202, $response->getStatusCode(), $response->getBody()->getContents());
        }

        return CommonMutateResponse::createFromResponse($response);
    }
}
