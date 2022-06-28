<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\Tests\Unit\Factory;

use CCT\SDK\CampaignWizard\ViewModel\CampaignWithDataImportId;

final class CampaignsWithDataImportIdsFactory
{
    public static function createMock(array $override): CampaignWithDataImportId
    {
        return CampaignWithDataImportId::fromArray(
            array_merge(
                self::defaultData(),
                $override
            )
        );
    }

    public static function defaultData(): array
    {
        return [
            'uuid' => 'df5ae270-20af-47dc-95a5-00a31b463ae7',
            'order_number' => 'SVR220600001PS',
            'data_import_id' => '9e6bcd67-abbe-44eb-8bb3-23ab4e4a83c2',
            'campaign_title' => 'Smårisvägen 12B, 139 55 Värmdö',
            "product" => [
                'name' => 'smartpremium',
                'additional_spending' => [
                    'amount' => 0,
                    'currency' => 'SEK',
                    'vat' => 25,
                    'amount_ex_vat' => 0
                ],
                'map_to' => null
            ],
            'campaign_period' => [
                'start_date' => '2022-06-15',
                'end_date' => '2022-06-24'
            ],
            'created_at' => '2022-06-14T07:22:15+00:00'
        ];
    }
}
