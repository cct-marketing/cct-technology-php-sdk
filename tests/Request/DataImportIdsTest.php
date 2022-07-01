<?php

namespace CCT\SDK\CampaignWizard\Tests\Request;

use Assert\InvalidArgumentException;
use CCT\SDK\CampaignWizard\Request\DataImportIds;
use PHPUnit\Framework\TestCase;

class DataImportIdsTest extends TestCase
{
    public function testNotAllContainingUuidThrowsInvalidArgumentException(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new DataImportIds(['Invalid_uuid']);
    }

    public function testEmptyArrayReturnsEmptyStringForToParams(): void
    {
        $dataImportId = new DataImportIds([]);

        $this->assertEquals('', $dataImportId->toParams());
    }

    public function testSingleUuidReturnsValidValue(): void
    {
        $dataImportId = new DataImportIds(['838697f1-6946-4079-bc88-87e91a542734']);

        $this->assertEquals(
            'data_import_ids[0]=838697f1-6946-4079-bc88-87e91a542734',
            urldecode($dataImportId->toParams())
        );
    }

    public function testMultipleUuidReturnsValidValue(): void
    {
        $dataImportId = new DataImportIds(
            ['838697f1-6946-4079-bc88-87e91a542734', '1fb38cd9-9920-4e20-a5cd-3d1bcb517072']
        );

        $this->assertEquals(
            'data_import_ids[0]=838697f1-6946-4079-bc88-87e91a542734&data_import_ids[1]=1fb38cd9-9920-4e20-a5cd-3d1bcb517072',
            urldecode($dataImportId->toParams())
        );
    }
}
