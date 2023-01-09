<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Details;

use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class Details extends AbstractMulti
{
    public function __construct(
        public readonly CampaignTitle $campaignTitle,
        public readonly CampaignPeriod $campaignPeriod,
        public readonly LandingPage $landingPage
    ) {
    }

    public function toArray(): array
    {
        return [
            'campaign_title' => $this->campaignTitle->toString(),
            'campaign_period' => $this->campaignPeriod->toArray(),
            'landing_page' => $this->landingPage->toString(),
        ];
    }

    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'campaign_title', self::errorPropertyPath());
        Assertion::string($data['campaign_title'], self::errorPropertyPath());
        Assertion::keyExists($data, 'campaign_period', self::errorPropertyPath());
        Assertion::keyExists($data, 'landing_page', self::errorPropertyPath());

        return new self(
            CampaignTitle::fromString($data['campaign_title']),
            CampaignPeriod::fromArray($data['campaign_period']),
            LandingPage::fromString($data['landing_page'])
        );
    }
}
