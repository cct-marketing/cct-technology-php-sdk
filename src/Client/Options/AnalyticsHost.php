<?php

declare(strict_types=1);

namespace CCT\SDK\Client\Options;

use CCT\SDK\Infrastucture\ValueObject\AbstractUrlOption;

final class AnalyticsHost extends AbstractUrlOption
{
    protected const HOST_URL = 'https://tool.cct-marketing.com';

    protected const SANDBOX_HOST_URL = 'https://staging.cct-marketing.com';
}
