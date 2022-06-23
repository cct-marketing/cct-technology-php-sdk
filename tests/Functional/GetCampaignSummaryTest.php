<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\Tests\Functional;

use CCT\SDK\CampaignWizard\Response\CampaignSummaryResponse;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Ramsey\Uuid\Uuid;

final class GetCampaignSummaryTest extends AbstractFunctionalTestCase
{
    public function testGetCampaignSummary(): void
    {
        $campaignSummaryResponse = $this->responseText(__DIR__.'/responses/campaign_summary.json');
        $data = json_decode($campaignSummaryResponse, true);

        $mock = new MockHandler(
            [new Response(200, [], $campaignSummaryResponse)]
        );

        $client = $this->createCampaignWizardClient($mock);

        try {
            $campaignSummaryResponse = $client->getCampaignSummary(Uuid::fromString('6e99ca2e-9cc1-4daf-b358-785a1ee85a3c'));
        } catch (RequestException $e) {
            $this->fail($e->getResponse()->getBody()->getContents());
        }


        $this->assertEquals($data['campaign'], $campaignSummaryResponse->toArray());
    }
}
