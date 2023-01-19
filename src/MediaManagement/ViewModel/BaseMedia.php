<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\ViewModel;

use CCT\SDK\Infrastucture\Serialization\Caster\CastToCollectionObject;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class BaseMedia extends AbstractMulti
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly ?string $description,
        public readonly bool $private,
        public readonly ?string $extension,
        public readonly Status $status,
        public readonly bool $external,
        #[CastToCollectionObject(ContextCollection::class)]
        public readonly ?ContextCollection $contexts,
        public readonly MediaType $type,
        public readonly ?string $endpoint,
        public readonly ?string $fileFormat,
        public readonly ?string $originalUri
    ) {
    }
}
