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
        $mock = new MockHandler(
            [new Response(200, [], $this->responseText(__DIR__.'/responses/campaign_summary.json'))]
        );

        $client = $this->createCampaignWizardClient($mock);

        try {
            $campaignSummaryResponse = $client->getCampaignSummary(Uuid::fromString('6e99ca2e-9cc1-4daf-b358-785a1ee85a3c'));
        } catch (RequestException $e) {
            $this->fail($e->getResponse()->getBody()->getContents());
        }

        $this->assertInstanceOf(CampaignSummaryResponse::class, $campaignSummaryResponse);
    }
}
