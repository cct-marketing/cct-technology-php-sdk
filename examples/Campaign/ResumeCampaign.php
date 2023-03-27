<?php

declare(strict_types=1);

namespace CCT\SDK\Examples\Campaign;

require __DIR__ . '/../../vendor/autoload.php';

use CCT\SDK\Campaign\Data\CampaignId;
use CCT\SDK\Client\ClientFactory;
use CCT\SDK\Customer\Data\CustomerId;
use CCT\SDK\Examples\OptionsForExamples;
use CCT\SDK\Exception\ApiExceptionInterface;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

$option = OptionsForExamples::create();

$cache = new ArrayAdapter();

$client = ClientFactory::create($option, $cache);

$customerId = CustomerId::fromString('{CUSTOMER_ID}');
$campaignId = CampaignId::fromString('{CAMPAIGN_ID}');

try {
    $response = $client->campaignClient()->resumeCampaign($customerId, $campaignId);
    printf('Campaign "%s" has been resumed %s', $response->campaignId->toString(), PHP_EOL);
} catch (IdentityProviderException $e) {
    printf('Auth error: %s', $e->getMessage());
    exit(1);
} catch (ApiExceptionInterface $e) {
    printf('Api Error: %s', $e->getMessage());
    exit(1);
}
