<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Payload;

use CCT\SDK\Campaign\Data\AdContent\AdContent;
use CCT\SDK\Campaign\Data\Details\Details;
use CCT\SDK\Campaign\Data\Options\Options;
use CCT\SDK\Campaign\Data\Targeting\Targeting;
use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class SaveCampaign extends AbstractMulti
{
    public function __construct(
        public readonly Details $details,
        public readonly AdContent $adContent,
        public readonly Targeting $targeting,
        public readonly Options $options
    ) {
    }

    public function toArray(): array
    {
        return [
            'details' => $this->details->toArray(),
            'ad_content' => $this->adContent->toArray(),
            'targeting' => $this->targeting->toArray(),
            'options' => $this->options->toArray(),
        ];
    }

    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'details', self::errorPropertyPath());
        Assertion::keyExists($data, 'ad_content', self::errorPropertyPath());
        Assertion::keyExists($data, 'targeting', self::errorPropertyPath());
        Assertion::keyExists($data, 'options', self::errorPropertyPath());

        return new self(
            Details::fromArray($data['details']),
            AdContent::fromArray($data['ad_content']),
            Targeting::fromArray($data['targeting']),
            Options::fromArray($data['options'])
        );
    }
}
