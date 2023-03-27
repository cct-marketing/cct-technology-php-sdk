<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data;

enum CampaignState: string
{
    case EXPIRED = 'expired';
    case DRAFT = 'draft';
    case READY = 'ready';
    case PLACED = 'placed';
    case CONTENT_REVIEW_NEEDED = 'content_review_needed';
    case REJECTED = 'rejected';
    case CONTENT_REVIEW_FINISHED = 'content_review_finished';
    case WAITING_FOR_APPROVAL = 'waiting_for_approval';
    case APPROVED = 'approved';

    case NEW = 'new';
    case NOT_APPROVED = 'not_approved';
    case PLANNED = 'planned';
    case LIVE = 'live';
    case PAUSED = 'paused';
    case STOPPED = 'stopped';
    case FINISHED = 'finished';
    case ARCHIVED = 'archived';
    case ON_HOLD = 'on_hold';
}
