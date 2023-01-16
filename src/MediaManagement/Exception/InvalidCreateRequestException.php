<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\Exception;

use CCT\SDK\Infrastucture\Assert\Exception\AssertionFailedException;
use CCT\SDK\MediaManagement\Request\Media\UploadMedia;

final class InvalidCreateRequestException extends AssertionFailedException
{
    public static function create(array $expectedFieldNames): self
    {
        return new self(
            sprintf(
                'Failed to convert data to media create type as it does not contain one of following fields "%s"',
                implode(', ', $expectedFieldNames)
            ),
            400
        );
    }

    public static function mediaUploadNotAllowed(UploadMedia $media): self
    {
        return new self(
            sprintf(
                'Media upload by form params is not supported: "%s"',
                $media->__toString()
            ),
            400
        );
    }
}
