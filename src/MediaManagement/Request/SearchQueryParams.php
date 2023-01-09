<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\Request;

use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\MediaManagement\Request\Context\Context;
use CCT\SDK\MediaManagement\Request\Media\MediaTypeCollection;
use CCT\SDK\MediaManagement\Request\Media\StatusCollection;

final class SearchQueryParams
{
    private function __construct(
        public readonly int $limit,
        public readonly int $page,
        public readonly ?string $q,
        public readonly ?MediaTypeCollection $types,
        public readonly ?string $id,
        public readonly ?string $sort,
        public readonly ?string $direction,
        public readonly ?StatusCollection $statuses,
        public readonly ?Context $context
    ) {
        $this->guard($limit, $id, $sort, $direction);
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['limit'] ?? 20,
            $data['page'] ?? 1,
            $data['q'] ?? null,
            isset($data['type']) ? MediaTypeCollection::fromArray($data['type']) : null,
            $data['id'] ?? null,
            $data['sort'] ?? null,
            $data['direction'] ?? null,
            isset($data['status']) ? StatusCollection::fromArray($data['status']) : null,
            isset($data['context']) ? Context::create($data['context']) : null
        );
    }

    public function toArray(): array
    {
        return [
            'limit' => $this->limit,
            'page' => $this->page,
            'q' => $this->q,
            'type' => $this->types?->toArray(),
            'id' => $this->id,
            'sort' => $this->sort,
            'direction' => $this->direction,
            'context' => $this->context?->name(),
            'status' => $this->statuses?->toArray(),
        ];
    }

    public function toQueryParams(): array
    {
        return array_filter(
            $this->toArray(),
            static function ($value) {
                return $value !== null;
            }
        );
    }

    private function guard(int $limit, ?string $id, ?string $sort, ?string $direction): void
    {
        Assertion::nullOrMax($limit, 1000, 'search_query_params');
        Assertion::nullOrUuid($id, 'search_query_params');
        Assertion::nullOrChoice(
            $sort,
            ['media.name', 'media.createdAt', 'media.updatedAt', 'media.extension', 'media.formatType'],
            'search_query_params'
        );

        Assertion::nullOrChoice($direction, ['asc', 'desc'], 'search_query_params');
    }
}
