<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignFlow\Response;

use CCT\SDK\CampaignFlow\Data\CampaignFlowId;
use CCT\SDK\CampaignFlow\Data\Category;
use CCT\SDK\CampaignFlow\Data\Pricing;
use CCT\SDK\CampaignFlow\Data\Settings;
use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class CampaignFlowItem extends AbstractMulti
{
    public function __construct(
        public readonly CampaignFlowId $id,
        public readonly string $name,
        public readonly string $label,
        public readonly Pricing $pricing,
        public readonly Category $category,
        public readonly Settings $settings
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->toString(),
            'name' => $this->name,
            'label' => $this->label,
            'pricing' => $this->pricing->toArray(),
            'category' => $this->category->value,
            'settings' => $this->settings->toArray(),
        ];
    }

    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'id', self::errorPropertyPath());
        Assertion::keyExists($data, 'name', self::errorPropertyPath());
        Assertion::keyExists($data, 'label', self::errorPropertyPath());
        Assertion::keyExists($data, 'pricing', self::errorPropertyPath());
        Assertion::keyExists($data, 'category', self::errorPropertyPath());
        Assertion::keyExists($data, 'settings', self::errorPropertyPath());

        return new self(
            CampaignFlowId::fromString($data['id']),
            $data['name'],
            $data['label'],
            Pricing::fromArray($data['pricing']),
            Category::from($data['category']),
            Settings::fromArray($data['settings'])
        );
    }
}
