<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignFlow;

use CCT\SDK\CampaignFlow\Response\ListResponse;
use CCT\SDK\Client\AbstractServiceClient;
use CCT\SDK\Customer\Data\CustomerId;
use CCT\SDK\Infrastucture\ValueObject\AbstractUrlOption;

final class CampaignFlowClient extends AbstractServiceClient
{
    public function list(CustomerId $customerId): ListResponse
    {
        $response = $this->listResources(
            $this->hostWithPath(sprintf('/customers/%s/campaign-flows/products', $customerId->toString()))
        );

        return ListResponse::fromArray($response);
    }

    public function host(): AbstractUrlOption
    {
        return $this->options->campaignWizardHost;
    }
}
