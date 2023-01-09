<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Functional;

final class CampaignDataHelper
{
    public static function campaignData(array $override): array
    {
        $startDate = (new \DateTimeImmutable())->modify('+ 2 days');
        $endDate = (new \DateTimeImmutable())->modify('+ 12 days');

        return array_replace_recursive([
            'details' => [
                'campaign_title' => 'Test of campaign sdk',
                'campaign_period' => [
                    'start_date' => $startDate->format('Y-m-d'),
                    'end_date' => $endDate->format('Y-m-d'),
                ],
                'landing_page' => 'http://test.com',
            ],
            'ad_content' => [
                'facebook_ai_multi_ad_variants' => [
                    [
                        'texts' => ['text 1', 'text 2', 'text 3'],
                        'headings' => ['heading 1', 'heading 2', 'heading 3'],
                        'descriptions' => ['description 1', 'description 2', 'description 3'],
                        'images' => [],
                        'videos' => [],
                    ],
                ],
            ],
            'targeting' => [
                'locations' => [
                    [
                        'address' => '55 Fruit St, Boston, MA 02114, USA',
                        'coordinate' => [
                            'latitude' => 42.36308280000001,
                            'longitude' => -71.0686204,
                        ],
                        'radius' => [
                            'radius' => 20,
                            'measurement_unit' => 'km',
                        ],
                    ],
                ],
                'industry_address' => [
                    'address' => [
                        'street_number' => '55',
                        'street_name' => 'Fruit Street',
                        'locality' => 'Boston',
                        'region' => 'Massachusetts',
                        'postal_code' => '02114',
                        'country' => [
                            'name' => 'United States',
                            'code' => 'US',
                        ],
                        'neighborhood' => null,
                    ],
                    'coordinate' => [
                        'latitude' => 42.36308280000001,
                        'longitude' => -71.0686204,
                    ],
                ],
                'property_information' => [
                    'property_price' => 120000000,
                    'property_size' => 40000,
                    'number_of_bedrooms' => 5,
                ],
            ],
            'options' => [
            ],
        ], $override);
    }
}
