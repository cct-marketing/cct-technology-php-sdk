<?php

namespace CCT\SDK\CampaignWizard\ValueObject\AfterSoldAction;

use CCT\SDK\CampaignWizard\ValueObject\AbstractEnum;

final class ActionType extends AbstractEnum
{
    public const RUN_WITH_SOLD_IMAGE = 'RUN_WITH_SOLD_IMAGE';
    public const RUN_WITH_SOLD_IMAGE_FROM_DATA_IMPORT = 'RUN_WITH_SOLD_IMAGE_FROM_DATA_IMPORT';
    public const CONVERT_TO_BRANDING = 'CONVERT_TO_BRANDING';
    public const STOP_AND_CREDIT = 'STOP_AND_CREDIT';
    public const SOLD_3DAYS_THEN_BRANDING = 'SOLD_3DAYS_THEN_BRANDING';
    public const SOLD_3DAYS_THEN_CREDIT = 'SOLD_3DAYS_THEN_CREDIT';
    public const BRANDING_3DAYS_THEN_CREDIT = 'BRANDING_3DAYS_THEN_CREDIT';
    public const MOVE_BUDGET_TO_NEW_PROJECT = 'MOVE_BUDGET_TO_NEW_PROJECT';
    public const END_CAMPAIGN_WITH_NO_FURTHER_ACTION = 'END_CAMPAIGN_WITH_NO_FURTHER_ACTION';
}
