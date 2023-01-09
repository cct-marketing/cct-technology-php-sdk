<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\ViewModel;

use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class SearchResult extends AbstractMulti
{
    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'total', self::errorPropertyPath());
        Assertion::keyExists($data, 'data', self::errorPropertyPath());
        Assertion::keyExists($data, 'page', self::errorPropertyPath());
        Assertion::keyExists($data, 'num_items_per_page', self::errorPropertyPath());
        Assertion::keyExists($data, 'page_count', self::errorPropertyPath());

        return new self(
            $data['total'],
            count($data['data']) > 0 ? MediaCollection::fromArray($data['data']) : MediaCollection::emptyList(),
            $data['page'],
            $data['num_items_per_page'],
            $data['page_count']
        );
    }

    private function __construct(
        public readonly int $total,
        public readonly MediaCollection $data,
        public readonly int $page,
        public readonly int $itemsPerPage,
        public readonly int $pageCount
    ) {
    }

    public function toArray(): array
    {
        return [
            'total' => $this->total,
            'data' => $this->data->toArray(),
            'page' => $this->page,
            'num_items_per_page' => $this->itemsPerPage,
            'page_count' => $this->pageCount,
        ];
    }
}
