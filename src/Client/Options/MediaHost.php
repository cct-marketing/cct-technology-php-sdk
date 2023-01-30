<?php

declare(strict_types=1);

namespace CCT\SDK\Client\Options;

use CCT\SDK\Infrastructure\ValueObject\AbstractUrlOption;

final class MediaHost extends AbstractUrlOption
{
    protected const HOST_URL = 'https://media-management.cct.marketing';

    protected const SANDBOX_HOST_URL = 'https://media-management-staging.cct.marketing';
}
