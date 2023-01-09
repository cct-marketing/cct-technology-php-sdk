<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\CampaignVideo;

use Assert\AssertionFailedException;
use CCT\SDK\Campaign\Data\AdContent\Video\VideoCollection;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class CampaignVideos extends AbstractMulti
{
    /**
     * @throws AssertionFailedException
     */
    public static function fromArray(array $data): static
    {
        return new self(isset($data['videos']) ? VideoCollection::fromArray($data['videos']) : VideoCollection::emptyList());
    }

    public static function create(
        VideoCollection $videoCollection,
    ): self {
        return new self($videoCollection);
    }

    /**
     * CampaignVideos constructor.
     */
    private function __construct(
        public readonly VideoCollection $videoCollection
    ) {
    }

    public function toArray(): array
    {
        return [
            'videos' => $this->videoCollection->toArray(),
            'user_selected' => true,
        ];
    }
}
