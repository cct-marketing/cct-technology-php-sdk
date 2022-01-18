<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\AdVariant\LinkedIn;

use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class LinkedInAdVariants extends AbstractValueObject
{
    /**
     * @var LinkedInAdVariant[]
     */
    private $linkedInAdVariants;

    /**
     * @param array $linkedInAdVariants
     *
     * @return self
     */
    public static function fromArray(array $linkedInAdVariants): self
    {
        return new self(...array_map(static function (array $linkedInAdVariant) {
            return LinkedInAdVariant::fromArray($linkedInAdVariant);
        }, $linkedInAdVariants));
    }

    /**
     * @param LinkedInAdVariant ...$linkedInAdVariants
     *
     * @return self
     */
    public static function fromItems(LinkedInAdVariant ...$linkedInAdVariants): self
    {
        return new self(...$linkedInAdVariants);
    }

    /**
     * @return self
     */
    public static function emptyList(): self
    {
        return new self();
    }

    /**
     * Constructor.
     *
     * @param LinkedInAdVariant ...$linkedInAdVariants
     */
    private function __construct(LinkedInAdVariant ...$linkedInAdVariants)
    {
        $this->linkedInAdVariants = $linkedInAdVariants;
    }

    /**
     * @param LinkedInAdVariant $linkedInAdVariant
     *
     * @return self
     */
    public function push(LinkedInAdVariant $linkedInAdVariant): self
    {
        $copy = clone $this;
        $copy->linkedInAdVariants[] = $linkedInAdVariant;

        return $copy;
    }

    /**
     * @return self
     */
    public function pop(): self
    {
        $copy = clone $this;
        array_pop($copy->linkedInAdVariants);

        return $copy;
    }

    /**
     * @return LinkedInAdVariant|null
     */
    public function first(): ?LinkedInAdVariant
    {
        return $this->linkedInAdVariants[0] ?? null;
    }

    /**
     * @return LinkedInAdVariant|null
     */
    public function last(): ?LinkedInAdVariant
    {
        if (count($this->linkedInAdVariants) === 0) {
            return null;
        }

        return $this->linkedInAdVariants[count($this->linkedInAdVariants) - 1];
    }

    /**
     * @param LinkedInAdVariant $linkedInAdVariant
     *
     * @return bool
     */
    public function contains(LinkedInAdVariant $linkedInAdVariant): bool
    {
        foreach ($this->linkedInAdVariants as $existingLinkedInAdVariant) {
            if ($existingLinkedInAdVariant->equals($linkedInAdVariant)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return LinkedInAdVariant[]
     */
    public function linkedInAdVariants(): array
    {
        return $this->linkedInAdVariants;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_map(static function (LinkedInAdVariant $linkedInAdVariant) {
            return $linkedInAdVariant->toArray();
        }, $this->linkedInAdVariants);
    }

    /**
     * @param ValueObjectInterface $other
     *
     * @return bool
     */
    public function equals(ValueObjectInterface $other): bool
    {
        if (!$other instanceof self) {
            return false;
        }

        return $this->toArray() === $other->toArray();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) json_encode($this->toArray());
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->linkedInAdVariants);
    }

    /**
     * @return self
     */
    public function removeEmptyVariants(): self
    {
        $items = array_values(
            array_filter($this->linkedInAdVariants, static function (LinkedInAdVariant $linkedInAdVariant) {
                return false === $linkedInAdVariant->isEmpty();
            })
        );

        return self::fromItems(...$items);
    }
}
