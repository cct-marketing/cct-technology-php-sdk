<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\Request\Media;

use CCT\SDK\Infrastucture\ValueObject\AbstractUuid;
use Ramsey\Uuid\Uuid;

final class MediaId extends AbstractUuid
{
    public static function create(): self
    {
        return new self(Uuid::uuid4());
    }
}
