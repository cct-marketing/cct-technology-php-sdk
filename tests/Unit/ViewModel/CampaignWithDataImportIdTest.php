<?php

namespace CCT\SDK\CampaignWizard\Tests\Unit\ViewModel;

use CCT\SDK\CampaignWizard\Tests\Unit\Factory\CampaignsWithDataImportIdsFactory;
use CCT\SDK\CampaignWizard\ViewModel\CampaignWithDataImportId;
use PHPUnit\Framework\TestCase;

class CampaignWithDataImportIdTest extends TestCase
{
    public function testToArray(): void
    {
        $campaignWithDataImportId = CampaignsWithDataImportIdsFactory::createMock([]);

        $this->assertEquals(CampaignsWithDataImportIdsFactory::defaultData(), $campaignWithDataImportId->toArray());
    }
}
