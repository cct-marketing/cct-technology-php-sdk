<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\ViewModel\Factory;

use CCT\SDK\MediaManagement\Exception\InvalidRequestTypeException;
use CCT\SDK\MediaManagement\ViewModel\MediaAudio;
use CCT\SDK\MediaManagement\ViewModel\MediaDocument;
use CCT\SDK\MediaManagement\ViewModel\MediaFacebookVideo;
use CCT\SDK\MediaManagement\ViewModel\MediaImage;
use CCT\SDK\MediaManagement\ViewModel\MediaInterface;
use CCT\SDK\MediaManagement\ViewModel\MediaType;
use CCT\SDK\MediaManagement\ViewModel\MediaVideo;

final class MediaFactory
{
    public static function fromArray(array $medium): MediaInterface
    {
        $types = self::typesToClass();
        if (!isset($medium['type'], $types[$medium['type']])) {
            throw InvalidRequestTypeException::create($medium['type'] ?? '', array_keys($types));
        }

        $className = $types[$medium['type']];

        return $className::fromArray($medium);
    }

    public static function toArray(MediaInterface $medium): array
    {
        $types = self::typesToClass();

        $data = $medium->toArray();
        $className = get_class($medium);

        if (!in_array($className, $types, true)) {
            throw new \RuntimeException(
                sprintf(
                    'Class type "%s" is not supported. Allowed classes "%s"',
                    $className,
                    implode(', ', $types)
                )
            );
        }

        $data['type'] = array_search($className, $types, true);

        return $data;
    }

    private static function typesToClass(): array
    {
        return [
            MediaType::IMAGE->value => MediaImage::class,
            MediaType::VIDEO->value => MediaVideo::class,
            MediaType::FACEBOOK_VIDEO->value => MediaFacebookVideo::class,
            MediaType::DOCUMENT->value => MediaDocument::class,
            MediaType::AUDIO->value => MediaAudio::class,
        ];
    }
}
