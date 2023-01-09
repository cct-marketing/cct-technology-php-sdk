<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\Request\Media;

use Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;
use CCT\SDK\MediaManagement\ViewModel\MediaType;

final class FacebookVideoMedia extends AbstractMulti implements CreateMediaInterface
{
    public static function fromArray(array $data): static
    {
        // Assertion::keyExists($data, 'name');
        Assertion::keyExists($data, 'facebook_video_id');
        Assertion::keyExists($data, 'external_url');

        $data['type'] = MediaType::FACEBOOK_VIDEO;

        return new self(
            BaseMediaCreate::fromArray($data),
            $data['facebook_video_id'],
            $data['external_url']
        );
    }

    private function __construct(
        public readonly BaseMediaCreate $baseMediaCreate,
        public readonly int $facebookVideoId,
        public readonly string $externalUrl
    ) {
    }

    public function toArray(): array
    {
        return array_merge(
            $this->baseMediaCreate->toArray(),
            [
                'facebook_video_id' => $this->facebookVideoId,
                'external_url' => $this->externalUrl,
                'private' => null,
            ]
        );
    }
}
