<?php

declare(strict_types=1);

namespace CCT\SDK\Client\Options;

use CCT\SDK\Infrastructure\ValueObject\AbstractUrlOption;

final class CampaignWizardHost extends AbstractUrlOption
{
    protected const HOST_URL = 'https://cw-api.cct.marketing';
    protected const SANDBOX_HOST_URL = 'https://cw-api-staging.cct.marketing';
}
