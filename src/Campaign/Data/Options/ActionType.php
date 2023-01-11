<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Options;

enum ActionType: string
{
    case RUN_WITH_SOLD_IMAGE = 'RUN_WITH_SOLD_IMAGE';
    case RUN_WITH_SOLD_IMAGE_FROM_DATA_IMPORT = 'RUN_WITH_SOLD_IMAGE_FROM_DATA_IMPORT';
    case CONVERT_TO_BRANDING = 'CONVERT_TO_BRANDING';
    case STOP_AND_CREDIT = 'STOP_AND_CREDIT';
    case SOLD_3DAYS_THEN_BRANDING = 'SOLD_3DAYS_THEN_BRANDING';
    case SOLD_3DAYS_THEN_CREDIT = 'SOLD_3DAYS_THEN_CREDIT';
    case BRANDING_3DAYS_THEN_CREDIT = 'BRANDING_3DAYS_THEN_CREDIT';
    case MOVE_BUDGET_TO_NEW_PROJECT = 'MOVE_BUDGET_TO_NEW_PROJECT';
    case END_CAMPAIGN_WITH_NO_FURTHER_ACTION = 'END_CAMPAIGN_WITH_NO_FURTHER_ACTION';
}