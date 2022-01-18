<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\Tests\Functional;

use CCT\SDK\CampaignWizard\CampaignWizardClient;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use Nyholm\Psr7\Factory\Psr17Factory;
use PHPUnit\Framework\TestCase;

abstract class AbstractFunctionalTestCase extends TestCase
{
    /**
     * @return CampaignWizardClient
     */
    protected function createCampaignWizardClient(MockHandler $handler): CampaignWizardClient
    {
        $client = $this->getClient($handler);
        $requestFactory = new Psr17Factory();

        $campaignWizardClient = new CampaignWizardClient($client, $requestFactory);
        if (in_array(getenv('ENABLE_DEBUG'), ['true', true, 1], true)) {
            $campaignWizardClient->enableDebug();
        }

        return $campaignWizardClient;
    }

    /**
     * @param MockHandler|null $handler
     *
     * @return Client
     */
    protected function getClient(?MockHandler $handler): Client
    {
        if (false === in_array(getenv('USE_MOCK_RESPONSES'), ['true', true, 1, '1'], true)) {
            $handler = null;
        }

        return new Client(
            [
                'base_uri' => getenv('CAMPAIGN_WIZARD_URL'),
                'timeout' => 0,
                'allow_redirects' => false,
                'handler' => $handler,
                'headers' => [
                    'X-Requested-With' => 'XMLHttpRequest',
                ],
                'debug' => true
            ]
        );
    }

    protected function responseText(string $file): string
    {
        return file_get_contents($file);
    }
}
