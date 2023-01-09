<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Unit\Campaign\Data\Details;

use CCT\SDK\Campaign\Data\Details\Details;

final class DetailsData
{
    public static function dataWithOverride(array $data = []): array
    {
        return array_merge(
            [
                'campaign_title' => 'My Campaign',
                'campaign_period' => [
                    'start_date' => '2022-01-01',
                    'end_date' => '2022-01-07',
                ],
                'landing_page' => 'https://example.com',
            ],
            $data
        );
    }

    public static function createObject(array $data = []): Details
    {
        return Details::fromArray(self::dataWithOverride($data));
    }
}
