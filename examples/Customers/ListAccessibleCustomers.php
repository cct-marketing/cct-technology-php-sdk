<?php

declare(strict_types=1);

namespace CCT\SDK\Examples\Customers;

require __DIR__ . '/../../vendor/autoload.php';

use CCT\SDK\Client\CctClientFactory;
use CCT\SDK\Customer\Response\List\Agency;
use CCT\SDK\Customer\Response\List\Customer;
use CCT\SDK\Examples\OptionsForExamples;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

$option = OptionsForExamples::create();

$cache = new ArrayAdapter();

$cctClient = CctClientFactory::create($option, $cache);

try {
    $listResult = $cctClient->customerClient()->list();
} catch (IdentityProviderException $e) {
    printf('Auth error: %s', $e->getMessage());
    exit(1);
}

/** @var Agency $agency */
foreach ($listResult as $agency) {
    printf('Customer Agency "%s" with id "%s" %s', $agency->name->toString(), $agency->id->toString(), PHP_EOL);
    printf('Agency customers:%s', PHP_EOL);
    /** @var Customer $customer */
    foreach ($agency->customers as $customer) {
        printf('    Customer "%s" with id "%s"%s', $customer->name->toString(), $customer->id->toString(), PHP_EOL);
    }
}
