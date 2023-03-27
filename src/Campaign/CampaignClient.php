<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign;

use CCT\SDK\Campaign\Data\CampaignId;
use CCT\SDK\Campaign\Payload\SaveCampaign;
use CCT\SDK\Campaign\Payload\StartCampaign;
use CCT\SDK\Campaign\Response\CampaignStateResponse;
use CCT\SDK\Campaign\Response\CommonMutateResponse;
use CCT\SDK\Client\AbstractServiceClient;
use CCT\SDK\Client\Options\Options;
use CCT\SDK\Customer\Data\CustomerId;
use CCT\SDK\Infrastructure\ValueObject\AbstractUrlOption;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

final class CampaignClient extends AbstractServiceClient
{
    public function __construct(protected readonly Options $options, protected readonly Client $client)
    {
    }

    public function startCampaign(StartCampaign $startCampaign, CustomerId $customerId): CommonMutateResponse
    {
        $request = new Request(
            'POST',
            sprintf('customers/%s/campaigns/start', $customerId->toString()),
            [],
            json_encode($startCampaign->toArray(), JSON_THROW_ON_ERROR)
        );

        $data = $this->sendJsonRequest($request, 201);

        return CommonMutateResponse::fromArray($data);
    }

    public function saveCampaign(SaveCampaign $saveCampaign, CustomerId $customerId, CampaignId $campaignId): CommonMutateResponse
    {
        $request = new Request(
            'PATCH',
            sprintf('customers/%s/campaigns/%s', $customerId->toString(), $campaignId->toString()),
            [],
            json_encode($saveCampaign->toArray(), JSON_THROW_ON_ERROR)
        );

        $data = $this->sendJsonRequest($request, 200);

        return CommonMutateResponse::fromArray($data);
    }

    public function placeCampaign(CustomerId $customerId, CampaignId $campaignId): CommonMutateResponse
    {
        $request = new Request(
            'POST',
            sprintf('customers/%s/campaigns/%s/place', $customerId->toString(), $campaignId->toString())
        );

        $data = $this->sendJsonRequest($request, 202);

        return CommonMutateResponse::fromArray($data);
    }

    public function getCampaignState(CustomerId $customerId, CampaignId $campaignId): CampaignStateResponse
    {
        $request = new Request(
            'GET',
            sprintf('customers/%s/campaigns/%s/state', $customerId->toString(), $campaignId->toString())
        );

        $data = $this->sendJsonRequest($request, 200);

        return CampaignStateResponse::fromArray($data);
    }

    public function pauseCampaign(CustomerId $customerId, CampaignId $campaignId): CommonMutateResponse
    {
        $request = new Request(
            'POST',
            sprintf('customers/%s/campaigns/%s/pause', $customerId->toString(), $campaignId->toString())
        );

        $data = $this->sendJsonRequest($request, 200);

        return CommonMutateResponse::fromArray($data);
    }

    public function resumeCampaign(CustomerId $customerId, CampaignId $campaignId): CommonMutateResponse
    {
        $request = new Request(
            'POST',
            sprintf('customers/%s/campaigns/%s/resume', $customerId->toString(), $campaignId->toString())
        );

        $data = $this->sendJsonRequest($request, 200);

        return CommonMutateResponse::fromArray($data);
    }

    public function host(): AbstractUrlOption
    {
        return $this->options->campaignWizardHost;
    }
}
