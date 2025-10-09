<?php

namespace CCT\SDK\MediaManagement;

use CCT\SDK\Campaign\Data\CampaignId;
use CCT\SDK\Client\AbstractServiceClient;
use CCT\SDK\Customer\Data\CustomerId;
use CCT\SDK\Infrastructure\ValueObject\AbstractUrlOption;
use CCT\SDK\MediaManagement\Request\Media\CreateMediaCollection;
use CCT\SDK\MediaManagement\Request\Media\CreateMediaInterface;
use CCT\SDK\MediaManagement\ViewModel\MediaCollection;
use CCT\SDK\MediaManagement\ViewModel\MediaInterface;
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

    public function createMedia(CustomerId $customerId, CreateMediaInterface $media): MediaInterface
    {
        $request = new Request(
            'POST',
            sprintf('/customers/%s/medium', $customerId->toString()),
            $this->getHeaders()
        );

        $responseData = $this->sendJsonRequest(
            $request,
            201,
            [
                RequestOptions::FORM_PARAMS => [
                    'media' => $media->toArray(),
                ],
            ]
        );

        $mediaItem = MediaCollection::fromArray([$responseData])->first();

        if (!$mediaItem instanceof MediaInterface) {
            throw new \RuntimeException('Unexpected response from server, media item not found.');
        }

        return $mediaItem;
    }

    public function host(): AbstractUrlOption
    {
        return $this->options->mediaHost;
    }
}
