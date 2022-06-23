<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\Tests\Functional;

use CCT\SDK\CampaignWizard\CampaignWizardClient;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Request;
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

    /**
     * @return CampaignWizardClient
     */
    protected function createClientWithConnectionTimeoutError(): CampaignWizardClient
    {
        $handler = new CurlHandler();

        $client = new Client(
            [
                'base_uri' => 'http://localhost:123',
                'handler' => $handler,
                'timeout' => 0.001,
                'connect_timeout' => 0.001
            ]
        );

        $requestFactory = new Psr17Factory();

        return new CampaignWizardClient($client, $requestFactory);
    }
}
