<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\Exception;

use CCT\SDK\Exception\RequestException;
use CCT\SDK\MediaManagement\Request\Media\UploadMedia;

final class InvalidCreateRequestException extends RequestException
{
    public static function create(array $expectedFieldNames): self
    {
        return new self(
            sprintf(
                'Failed to convert data to media create type as it most contain one of following fields "%s"',
                implode(', ', $expectedFieldNames)
            )
        );
    }

    public static function mediaUploadNotAllowed(UploadMedia $media): self
    {
        return new self(
            sprintf(
                'Media upload by form params is not supported: "%s"',
                $media->__toString()
            )
        );
    }
}
