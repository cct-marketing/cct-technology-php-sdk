<?php

declare(strict_types=1);

namespace CCT\SDK\Examples\Campaign;

require __DIR__ . '/../../vendor/autoload.php';

use CCT\SDK\CampaignFlow\Data\PricingItem;
use CCT\SDK\CampaignFlow\Response\CampaignFlowItem;
use CCT\SDK\Client\ClientFactory;
use CCT\SDK\Customer\Data\CustomerId;
use CCT\SDK\Examples\OptionsForExamples;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

$option = OptionsForExamples::create();

$cache = new ArrayAdapter();

$client = ClientFactory::create($option, $cache);

// See ListAccessibleCustomers.php to get the list of customer id you have access too
$customerId = CustomerId::fromString('{CUSTOMER_ID}'); // Specify the Customer ID for the campaign you wish to create.

try {
    $listResult = $client->campaignFlowClient()->list($customerId);
} catch (IdentityProviderException $e) {
    printf('Auth error: %s', $e->getMessage());
    exit(1);
}

/** @var CampaignFlowItem $campaignFlowItem */
foreach ($listResult as $campaignFlowItem) {
    printf('Product "%s" %s', $campaignFlowItem->name, PHP_EOL);
    printf('  - id: %s%s', $campaignFlowItem->id->toString(), PHP_EOL);
    printf('  - label: %s%s', $campaignFlowItem->label, PHP_EOL);
    printf('  - category: %s%s', $campaignFlowItem->category->value, PHP_EOL);
    printf('  - pricing: %s', PHP_EOL);
    /** @var PricingItem $item */
    foreach ($campaignFlowItem->pricing as $item) {
        printf('    - type: %s - price: %d%s', $item->type->value, $item->price, PHP_EOL);
    }
    printf('  - vat: %d%%%s', $campaignFlowItem->settings->vat->toFloat(), PHP_EOL);
    printf('  - price excludes vat: %s%s', $campaignFlowItem->settings->excludeVat->enabled->toString(), PHP_EOL);
}
