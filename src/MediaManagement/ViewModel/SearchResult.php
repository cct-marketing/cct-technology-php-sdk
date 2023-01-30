<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\ViewModel;

use CCT\SDK\Infrastructure\Serialization\Caster\CastToCollectionObject;
use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class SearchResult extends AbstractMulti
{
    private function __construct(
        public readonly int $total,
        #[CastToCollectionObject(MediaCollection::class)]
        public readonly MediaCollection $data,
        public readonly int $page,
        public readonly int $itemsPerPage,
        public readonly int $pageCount
    ) {
    }
}
