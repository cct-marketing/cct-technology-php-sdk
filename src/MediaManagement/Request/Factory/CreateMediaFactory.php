<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\Request\Factory;

use CCT\SDK\MediaManagement\Exception\InvalidCreateRequestException;
use CCT\SDK\MediaManagement\Request\Media\CreateMediaInterface;
use CCT\SDK\MediaManagement\Request\Media\ExternalMedia;
use CCT\SDK\MediaManagement\Request\Media\RemoteMedia;
use CCT\SDK\MediaManagement\Request\Media\UploadMedia;

final class CreateMediaFactory
{
    /**
     * @var array
     */
    private static $types = [
        'remote_file' => RemoteMedia::class,
        'external_url' => ExternalMedia::class,
        'file_resource' => UploadMedia::class,
    ];

    public static function fromArray(array $medium): CreateMediaInterface
    {
        $fieldNames = array_keys($medium);
        foreach (self::$types as $type => $className) {
            if (false === in_array($type, $fieldNames, true)) {
                continue;
            }

            return $className::fromArray($medium);
        }

        throw InvalidCreateRequestException::create(array_keys(self::$types));
    }
}
