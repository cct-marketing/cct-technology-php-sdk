<?php

declare(strict_types=1);

namespace CCT\SDK\Client\Options;

use CCT\SDK\Client\AuthProvider\Credentials;
use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;

final class Options extends AbstractMulti
{
    public function __construct(
        public readonly Mode $mode,
        public readonly Credentials $credentials,
        public readonly OAuthHost $oAuthHost,
        public readonly CampaignWizardHost $campaignWizardHost,
        public readonly MediaHost $mediaHost,
        public readonly CustomerHost $customerHost,
        public readonly AnalyticsHost $analyticsHost,
        public readonly bool $debug
    ) {
    }

    public function toArray(): array
    {
        return array_merge(
            $this->credentials->toArray(),
            [
                'mode' => $this->mode->value,
                'oauth_host' => $this->oAuthHost->toString(),
                'campaign_wizard_host' => $this->campaignWizardHost->toString(),
                'media_host' => $this->mediaHost->toString(),
                'customer_host' => $this->customerHost->toString(),
                'analytics_host' => $this->analyticsHost->toString(),
                'debug' => $this->debug,
            ]
        );
    }

    public static function fromArray(array $data): static
    {
        $mode = isset($data['mode']) ? Mode::from($data['mode']) : Mode::SANDBOX;

        return new self(
            $mode,
            Credentials::fromArray($data),
            isset($data['oauth_host']) ? OAuthHost::fromString($data['oauth_host']) : OAuthHost::createDefault($mode),
            isset($data['campaign_wizard_host']) ? CampaignWizardHost::fromString($data['campaign_wizard_host']) : CampaignWizardHost::createDefault($mode),
            isset($data['media_host']) ? MediaHost::fromString($data['media_host']) : MediaHost::createDefault($mode),
            isset($data['customer_host']) ? CustomerHost::fromString($data['customer_host']) : CustomerHost::createDefault($mode),
            isset($data['analytics_host']) ? AnalyticsHost::fromString($data['analytics_host']) : AnalyticsHost::createDefault($mode),
            $data['debug'] ?? false
        );
    }
}
