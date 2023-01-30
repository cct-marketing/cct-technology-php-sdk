<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Functional;

use CCT\SDK\Client\AuthProvider\Credentials;
use CCT\SDK\Client\Client;
use CCT\SDK\Client\ClientFactory;
use CCT\SDK\Client\Options\AnalyticsHost;
use CCT\SDK\Client\Options\CampaignWizardHost;
use CCT\SDK\Client\Options\CustomerHost;
use CCT\SDK\Client\Options\MediaHost;
use CCT\SDK\Client\Options\Mode;
use CCT\SDK\Client\Options\OAuthHost;
use CCT\SDK\Client\Options\Options;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

final class CCTClientMockFactory
{
    public function createCctClient(): Client
    {
        $credentials = new Credentials($this->configStringValue('CLIENT_ID'), $this->configStringValue('CLIENT_SECRET'));
        $oAuthHost = OAuthHost::createCustom($this->configStringValue('OAUTH_HOST'));
        $campaignWizardHost = CampaignWizardHost::createCustom($this->configStringValue('CAMPAIGN_WIZARD_HOST'));
        $mediaHost = MediaHost::createCustom($this->configStringValue('MEDIA_MANAGEMENT_HOST'));
        $customerHost = CustomerHost::createCustom($this->configStringValue('CUSTOMER_HOST'));
        $analyticsHost = AnalyticsHost::createCustom($this->configStringValue('ANALYTICS_HOST'));
        $debug = $this->configBoolValue('DEBUG_ENABLED');

        $option = new Options(Mode::SANDBOX, $credentials, $oAuthHost, $campaignWizardHost, $mediaHost, $customerHost, $analyticsHost, $debug);

        $cache = new ArrayAdapter();

        return ClientFactory::create($option, $cache);
    }

    public function configBoolValue(string $name): bool
    {
        return in_array(getenv($name), [true, 1, 'true', '1'], true);
    }

    public function configStringValue(string $name): string
    {
        return (string) getenv($name);
    }
}
