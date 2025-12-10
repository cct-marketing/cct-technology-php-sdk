<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Metadata;

use CCT\SDK\Campaign\Data\Metadata\Agent\Agents;
use CCT\SDK\Campaign\Data\Metadata\Generic\GenericItems;
use CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject;
use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class Metadata extends AbstractMulti
{
    public function __construct(
        #[CastToCollectionObject(Agents::class)]
        public readonly ?Agents $agents,
        #[CastToCollectionObject(GenericItems::class)]
        public readonly ?GenericItems $generic = null
    ) {
    }
}
