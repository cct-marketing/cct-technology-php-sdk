<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\ViewModel;

enum Status: string
{
    case UPLOADING = 'uploading';
    case PROCESSING = 'processing';
    case READY = 'ready';
    case NEW_MEDIA = 'new';
    case ERROR = 'error';
}
