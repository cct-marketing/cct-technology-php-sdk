<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\ViewModel;

enum MediaType: string
{
    case IMAGE = 'image';
    case VIDEO = 'video';
    case DOCUMENT = 'document';
    case AUDIO = 'audio';
    case FACEBOOK_VIDEO = 'facebook_video';
}
