<?php

namespace CCT\SDK\MediaManagement;

use CCT\SDK\Campaign\Data\CampaignUuid;
use CCT\SDK\Client\Options\Options;
use CCT\SDK\Customer\Data\CustomerId;
use CCT\SDK\MediaManagement\Exception\BadRequestException;
use CCT\SDK\MediaManagement\Request\Media\CreateMediaCollection;
use CCT\SDK\MediaManagement\ViewModel\MediaCollection;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class MediaClient
{
    public function __construct(private readonly Options $options, private readonly Client $client)
    {
    }

    private function getHeaders(): array
    {
        return [
            'X-Requested-With' => 'XMLHttpRequest',
        ];
    }

    public function createBulkMedia(CustomerId $customerId, CampaignUuid $campaignUuid, CreateMediaCollection $createMediaCollection): MediaCollection
    {
        $request = new Request('POST', $this->hostWithPath(
            sprintf('/customers/%s/campaigns/%s/media', $customerId->toString(), $campaignUuid->toString())
        ));

        $response = $this->client->send(
            $request,
            [
                'form_params' => [
                    'bulk_create' => [
                        'media' => $createMediaCollection->toFormParam(),
                    ],
                ],
                'headers' => $this->getHeaders(),
                'http_errors' => false,
                'debug' => $this->options->debug,
            ]
        );

        $statusCode = $response->getStatusCode();

        if ($statusCode !== 201 && $statusCode !== 409) {
            throw BadRequestException::create($request, $response);
        }

        $data = json_decode((string) $response->getBody(), true, 512, JSON_THROW_ON_ERROR);

        return MediaCollection::fromArray($data);
    }

    private function hostWithPath(string $path): string
    {
        return $this->options->mediaHost->withPath($path)->toString();
    }
}
