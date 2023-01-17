<?php

declare(strict_types=1);

namespace CCT\SDK\Examples\Campaign;

require __DIR__ . '/../../vendor/autoload.php';

use CCT\SDK\Campaign\Data\CampaignId;
use CCT\SDK\Campaign\Payload\SaveCampaign;
use CCT\SDK\Client\CctClientFactory;
use CCT\SDK\Customer\Data\CustomerId;
use CCT\SDK\Examples\OptionsForExamples;
use CCT\SDK\Exception\ApiRequestException;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

$option = OptionsForExamples::create();

// See ListAccessibleCustomers.php to get the list of customer id you have access too
$customerId = CustomerId::fromString('{CUSTOMER_ID}'); // Specify the Customer ID for the campaign you wish to create.

$campaignId = CampaignId::fromString('{CAMPAIGN_ID}'); // Specify the Campaign ID you wish to update. The campaign must still be in draft.

$cache = new ArrayAdapter();
$cctClient = CctClientFactory::create($option, $cache);

$saveCampaign = SaveCampaign::fromArray(
    [
        'ad_content' => [
            [
                'google_responsive_ad_variants' => [
                    'short_headlines' => ['Short headline 1', 'Short headline 2'],
                    'long_headline' => ['long headline'],
                    'descriptions' => ['Description 1', 'Description 2', 'Description 3'],
                ],
            ],
        ],
    ]
);

try {
    $cctClient->campaignClient()->saveCampaign($saveCampaign, $customerId, $campaignId);
} catch (ApiRequestException $requestException) {
    printf('Campaign with uuid "%s" failed to save with error %s', $requestException->getMessage(), PHP_EOL);
    exit(1);
}

printf('Campaign with uuid "%s" saved %s', $campaignId->toString(), PHP_EOL);
