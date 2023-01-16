<?php

namespace CCT\SDK\MediaManagement;

use CCT\SDK\Campaign\Data\CampaignId;
use CCT\SDK\Client\AbstractServiceClient;
use CCT\SDK\Customer\Data\CustomerId;
use CCT\SDK\Infrastucture\ValueObject\AbstractUrlOption;
use CCT\SDK\MediaManagement\Request\Media\CreateMediaCollection;
use CCT\SDK\MediaManagement\ViewModel\MediaCollection;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;

class MediaClient extends AbstractServiceClient
{
    private function getHeaders(): array
    {
        return [
            'X-Requested-With' => 'XMLHttpRequest',
        ];
    }

    public function createBulkMedia(CustomerId $customerId, CampaignId $campaignId, CreateMediaCollection $createMediaCollection): MediaCollection
    {
        $request = new Request(
            'POST',
            sprintf('/customers/%s/campaigns/%s/media', $customerId->toString(), $campaignId->toString()),
            $this->getHeaders()
        );

        $responseData = $this->sendJsonRequest(
            $request,
            201,
            [
                RequestOptions::FORM_PARAMS => [
                    'bulk_create' => [
                        'media' => $createMediaCollection->toFormParam(),
                    ],
                ],
            ]
        );

        return MediaCollection::fromArray($responseData);
    }

    public function host(): AbstractUrlOption
    {
        return $this->options->mediaHost;
    }
}
