<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\Tests\Functional;

use CCT\SDK\CampaignWizard\Exception\InvalidStatusCodeException;
use CCT\SDK\CampaignWizard\Exception\NetworkException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

final class CampaignsPlacedByDataImportIdsTest extends AbstractFunctionalTestCase
{
    public function testGetCampaignSummary(): void
    {
        $mock = new MockHandler(
            [new Response(200, [], $this->responseText(__DIR__.'/responses/campaigns_placed_by_data_import_ids.json'))]
        );

        $client = $this->createCampaignWizardClient($mock);

        $response = $client->campaignsPlacedByDataImportIds(['9e6bcd67-abbe-44eb-8bb3-23ab4e4a83c2']);

        $this->assertEquals('df5ae270-20af-47dc-95a5-00a31b463ae7', $response->first()->uuid()->toString());
    }

    public function test500Error(): void
    {
        $this->expectException(InvalidStatusCodeException::class);
        $mock = new MockHandler(
            [new Response(500, [], 'Server Error')]
        );

        $client = $this->createCampaignWizardClient($mock);
        $client->campaignsPlacedByDataImportIds(['9e6bcd67-abbe-44eb-8bb3-23ab4e4a83c2']);
    }

    public function test400Error(): void
    {
        $this->expectException(InvalidStatusCodeException::class);
        $mock = new MockHandler(
            [new Response(400, [], 'Server Error')]
        );

        $client = $this->createCampaignWizardClient($mock);
        $client->campaignsPlacedByDataImportIds(['9e6bcd67-abbe-44eb-8bb3-23ab4e4a83c2']);
    }

    public function testNetworkTimeout(): void
    {
        $this->expectException(NetworkException::class);
        $client = $this->createClientWithConnectionTimeoutError();

        $client->campaignsPlacedByDataImportIds(['9e6bcd67-abbe-44eb-8bb3-23ab4e4a83c2']);
    }
}
