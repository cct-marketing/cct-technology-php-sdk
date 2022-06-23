<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\AdVariant\Google;

use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class GoogleAdVariants extends AbstractValueObject
{
    /**
     * @var GoogleAdVariant[]
     */
    private $googleAdVariants;

    public static function fromArray(array $googleAdVariants): self
    {
        return new self(...array_map(static function (array $googleAdVariant) {
            return GoogleAdVariant::fromArray($googleAdVariant);
        }, $googleAdVariants));
    }

    /**
     * @param GoogleAdVariant ...$googleAdVariants
     */
    public static function fromItems(GoogleAdVariant ...$googleAdVariants): self
    {
        return new self(...$googleAdVariants);
    }

    public static function emptyList(): self
    {
        return new self();
    }

    /**
     * Constructor.
     *
     * @param GoogleAdVariant ...$googleAdVariants
     */
    private function __construct(GoogleAdVariant ...$googleAdVariants)
    {
        $this->googleAdVariants = $googleAdVariants;
    }

    public function push(GoogleAdVariant $googleAdVariant): self
    {
        $copy = clone $this;
        $copy->googleAdVariants[] = $googleAdVariant;

        return $copy;
    }

    public function pop(): self
    {
        $copy = clone $this;
        array_pop($copy->googleAdVariants);

        return $copy;
    }

    public function first(): ?GoogleAdVariant
    {
        return $this->googleAdVariants[0] ?? null;
    }

    public function last(): ?GoogleAdVariant
    {
        if (count($this->googleAdVariants) === 0) {
            return null;
        }

        return $this->googleAdVariants[count($this->googleAdVariants) - 1];
    }

    public function contains(GoogleAdVariant $googleAdVariant): bool
    {
        foreach ($this->googleAdVariants as $existingGoogleAdVariant) {
            if ($existingGoogleAdVariant->equals($googleAdVariant)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return GoogleAdVariant[]
     */
    public function googleAdVariants(): array
    {
        return $this->googleAdVariants;
    }

    public function toArray(): array
    {
        return array_map(static function (GoogleAdVariant $googleAdVariant) {
            return $googleAdVariant->toArray();
        }, $this->googleAdVariants);
    }

    public function equals(ValueObjectInterface $other): bool
    {
        if (!$other instanceof self) {
            return false;
        }

        return $this->toArray() === $other->toArray();
    }

    public function __toString(): string
    {
        return (string) json_encode($this->toArray());
    }

    public function count(): int
    {
        return count($this->googleAdVariants);
    }

    public function removeEmptyVariants(): self
    {
        $items = array_values(
            array_filter($this->googleAdVariants, static function (GoogleAdVariant $googleAdVariant) {
                return false === $googleAdVariant->isEmpty();
            })
        );

        return self::fromItems(...$items);
    }
}
