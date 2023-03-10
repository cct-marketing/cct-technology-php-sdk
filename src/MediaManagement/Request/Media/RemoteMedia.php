<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\Request\Media;

use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapFrom;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class RemoteMedia extends AbstractMulti implements CreateMediaInterface
{
    public function __construct(
        #[MapFrom(['id', 'name', 'description', 'private', 'type', 'predefined_name'])]
        public readonly BaseMediaCreate $baseMediaCreate,
        public readonly string $remoteFile
    ) {
    }
}
