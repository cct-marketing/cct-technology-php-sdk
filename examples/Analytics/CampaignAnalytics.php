<?php

declare(strict_types=1);

namespace CCT\SDK\Examples\Analytics;

require __DIR__ . '/../../vendor/autoload.php';

use CCT\SDK\Campaign\Data\CampaignId;
use CCT\SDK\Client\CctClientFactory;
use CCT\SDK\Customer\Data\CustomerId;
use CCT\SDK\Examples\OptionsForExamples;
use CCT\SDK\Exception\ApiRequestException;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

$option = OptionsForExamples::create();

// See ListAccessibleCustomers.php to get the list of customer id you have access too
$customerId = CustomerId::fromString('{CUSTOMER_ID}'); // Specify the Customer ID
$campaignId = CampaignId::fromString('{CAMPAIGN_ID}'); // Specify the Campaign ID

$cache = new ArrayAdapter();

$cctClient = CctClientFactory::create($option, $cache);

try {
    $campaignAnalytics = $cctClient->analyticsClient()->campaignAnalytics($customerId, $campaignId);
} catch (IdentityProviderException $e) {
    printf('Auth error: %s', $e->getMessage());
    exit(1);
} catch (ApiRequestException $requestException) {
    printf('Failed to get analytics for campaign id "%s" with error %s %s', $campaignId->toString(), $requestException->getMessage(), PHP_EOL);
    exit(1);
}
$analyticData = $campaignAnalytics ? $campaignAnalytics->toString() : 'No data found';
printf('Analytic data from campaign "%s": %s %s', $campaignId->toString(), $analyticData, PHP_EOL);
