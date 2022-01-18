<?php

namespace CCT\SDK\CampaignWizard;

use CCT\SDK\CampaignWizard\Exception\InvalidStatusCodeException;
use CCT\SDK\CampaignWizard\Response\CampaignSummaryResponse;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
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

        if ($response->getStatusCode() !== 200) {
            throw InvalidStatusCodeException::create(
                200,
                $response->getStatusCode(),
                $response->getBody()->getContents()
            );
        }

        $body = $response->getBody()->getContents();

        if ($this->debug) {
            echo $body;
        }

        $data = json_decode((string) $response->getBody(), true);

        return CampaignSummaryResponse::fromArray($data);
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
}
