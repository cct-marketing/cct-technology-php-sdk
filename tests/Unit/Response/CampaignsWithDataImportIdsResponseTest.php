<?php

namespace CCT\SDK\CampaignWizard\Tests\Unit\Response;

use CCT\SDK\CampaignWizard\Response\CampaignsWithDataImportIdsResponse;
use CCT\SDK\CampaignWizard\Tests\Unit\Factory\CampaignsWithDataImportIdsFactory;
use PHPUnit\Framework\TestCase;

class CampaignsWithDataImportIdsResponseTest extends TestCase
{
    public function testCreateFromResponseData(): void
    {
        $campaignsWithDataImportIdsResponse = CampaignsWithDataImportIdsResponse::fromArray(
            $this->createMockResponseData()
        );

        $this->assertEquals(1, $campaignsWithDataImportIdsResponse->count());
        $campaignsWithDataImportId = $campaignsWithDataImportIdsResponse->first();
        $this->assertEquals('df5ae270-20af-47dc-95a5-00a31b463ae7', $campaignsWithDataImportId->uuid());
        $this->assertEquals('SVR220600001PS', $campaignsWithDataImportId->orderNumber());
        $this->assertEquals('9e6bcd67-abbe-44eb-8bb3-23ab4e4a83c2', $campaignsWithDataImportId->dataImportId());
        $this->assertEquals('Smårisvägen 12B, 139 55 Värmdö', $campaignsWithDataImportId->campaignTitle());
        $this->assertEquals('smartpremium', $campaignsWithDataImportId->product()->name());
        $this->assertNull($campaignsWithDataImportId->product()->mapTo());
        $this->assertEquals('2022-06-15', $campaignsWithDataImportId->campaignPeriod()->startDate()->format('Y-m-d'));
        $this->assertEquals('2022-06-24', $campaignsWithDataImportId->campaignPeriod()->endDate()->format('Y-m-d'));
    }

    private function createMockResponseData(): array
    {
        return [
            CampaignsWithDataImportIdsFactory::defaultData()
        ];
    }
}
