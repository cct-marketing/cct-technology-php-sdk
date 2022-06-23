<?php

namespace CCT\SDK\CampaignWizard;

use Assert\Assertion;
use CCT\SDK\CampaignWizard\Exception\InvalidStatusCodeException;
use CCT\SDK\CampaignWizard\Exception\NetworkException;
use CCT\SDK\CampaignWizard\Response\CampaignSummaryResponse;
use CCT\SDK\CampaignWizard\Response\CampaignsWithDataImportIdsResponse;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Client\NetworkExceptionInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Ramsey\Uuid\UuidInterface;

class CampaignWizardClient
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var bool
     */
    private $debug = false;

    /**
     * @var RequestFactoryInterface
     */
    private $requestFactory;

    public function __construct(ClientInterface $client, RequestFactoryInterface $requestFactory)
    {
        $this->client = $client;
        $this->requestFactory = $requestFactory;
    }

    public function enableDebug(): void
    {
        $this->debug = true;
    }

    public function getCampaignSummary(UuidInterface $uuid): CampaignSummaryResponse
    {
        $request = $this->requestFactory->createRequest('GET', sprintf('/campaign/%s/summary', $uuid->toString()));
        $response = $this->client->sendRequest($request);

        $data = $this->handleResponse($response, 200);

        return CampaignSummaryResponse::fromArray($data);
    }

    public function campaignsPlacedByDataImportIds(array $dataImportIds): CampaignsWithDataImportIdsResponse
    {
        Assertion::allUuid($dataImportIds, 'All ');
        $params = ltrim('&', implode('&data_import_ids[]=', $dataImportIds));

        $request = $this->requestFactory->createRequest('GET', sprintf('/campaigns/by-data-import_ids?%s', $params));
        $response = $this->sendRequest($request);

        $data = $this->handleResponse($response, 200);

        return CampaignsWithDataImportIdsResponse::fromArray($data);
    }

    /**
     * @return string[]
     */
    private function getHeaders(): array
    {
        return [
            'X-Requested-With' => 'XMLHttpRequest',
        ];
    }

    private function handleResponse(ResponseInterface $response, int $expectedStatusCode)
    {
        if ($response->getStatusCode() !== $expectedStatusCode) {
            throw InvalidStatusCodeException::create(
                $expectedStatusCode,
                $response->getStatusCode(),
                $response->getBody()->getContents()
            );
        }

        $body = $response->getBody()->getContents();

        if ($this->debug) {
            echo $body;
        }

        return json_decode((string) $response->getBody(), true);
    }

    /**
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    private function sendRequest(RequestInterface $request): ResponseInterface
    {
        try {
            return $this->client->sendRequest($request);
        } catch (NetworkExceptionInterface $networkException) {
            throw NetworkException::createFrom($networkException);
        }
    }
}
