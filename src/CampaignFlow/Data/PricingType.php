<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignFlow\Data;

enum PricingType: string
{
    case MEDIA_SPENDING = 'media_spending';

    case TECH_FEE = 'setup_fee';
}
