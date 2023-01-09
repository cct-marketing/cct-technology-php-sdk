<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Targeting\LocationTargeting;

enum LocationType: string
{
    case DEFAULT = 'default';
    case REAL_ESTATE = 'real_estate';
    case AUTOMOTIVE = 'automotive';
}
