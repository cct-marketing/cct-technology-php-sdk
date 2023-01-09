<?php

declare(strict_types=1);

namespace CCT\SDK\Client\Options;

use CCT\SDK\Infrastucture\ValueObject\AbstractUrlOption;

final class CampaignWizardHost extends AbstractUrlOption
{
    protected const HOST_URL = 'https://cw-api.cct.marketing';
}
