<?php

declare(strict_types=1);

namespace CCT\SDK\Client\Options;

use CCT\SDK\Client\AuthProvider\Credentials;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class Options extends AbstractMulti
{
    public function __construct(
        public readonly Credentials $credentials,
        public readonly OAuthHost $oAuthHost,
        public readonly CampaignWizardHost $campaignWizardHost,
        public readonly MediaHost $mediaHost,
        public readonly CustomerHost $customerHost,
        public readonly bool $debug
    ) {
    }

    public function toArray(): array
    {
        return array_merge(
            $this->credentials->toArray(),
            [
                'oauth_host' => $this->oAuthHost->toString(),
                'campaign_wizard_host' => $this->campaignWizardHost->toString(),
                'media_host' => $this->mediaHost->toString(),
                'customer_host' => $this->customerHost->toString(),
                'debug' => $this->debug,
            ]
        );
    }

    public static function fromArray(array $data): static
    {
        return new self(
            Credentials::fromArray($data),
            isset($data['oauth_host']) ? OAuthHost::fromString($data['oauth_host']) : OAuthHost::createDefault(),
            isset($data['campaign_wizard_host']) ? CampaignWizardHost::fromString($data['campaign_wizard_host']) : CampaignWizardHost::createDefault(),
            isset($data['media_host']) ? MediaHost::fromString($data['media_host']) : MediaHost::createDefault(),
            isset($data['customer_host']) ? CustomerHost::fromString($data['customer_host']) : CustomerHost::createDefault(),
            $data['debug'] ?? false
        );
    }
}
