<?php

namespace CCT\SDK\CampaignFlow\Data;

enum Category: string
{
    case DEFAULT = 'default';
    case REACTIVATE = 'reactivate';
    case SOLD = 'sold';
    case BRANDING = 'branding';
    case LEAD = 'lead';
    case PROJECT = 'project';
    case PROJECT_REACTIVATE = 'project-reactivate';
    case RECRUITMENT = 'recruitment';
    case RECRUITMENT_REACTIVATE = 'recruitment-reactivate';
    case LEAD_REACTIVATE = 'lead-reactivate';
}
