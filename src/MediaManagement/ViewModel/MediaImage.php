<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\ViewModel;

use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;
use CCT\SDK\MediaManagement\ViewModel\Traits\BaseMediaGettersTrait;
use EventSauce\ObjectHydrator\MapFrom;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class MediaImage extends AbstractMulti implements MediaInterface
{
    use BaseMediaGettersTrait;

    public function __construct(
        #[MapFrom(['id', 'name', 'description', 'private', 'extension', 'status', 'external', 'contexts', 'type', 'endpoint', 'file_format', 'original_uri'])]
        public readonly BaseMedia $baseMedia,
        public readonly ?int $contentSize,
        public readonly ?int $width,
        public readonly ?int $height
    ) {
    }
}
