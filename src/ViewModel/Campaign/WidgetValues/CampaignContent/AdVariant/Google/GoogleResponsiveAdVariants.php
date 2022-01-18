<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\AdVariant\Google;

use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class GoogleResponsiveAdVariants extends AbstractValueObject
{
    /**
     * @var GoogleResponsiveAdVariant[]
     */
    private $googleResponsiveAdVariants;

    /**
     * @param array $googleResponsiveAdVariants
     *
     * @return self
     *
     * @throws AssertionFailedException
     */
    public static function fromArray(array $googleResponsiveAdVariants): self
    {
        return new self(...array_map(static function (array $googleResponsiveAdVariant) {
            return GoogleResponsiveAdVariant::fromArray($googleResponsiveAdVariant);
        }, $googleResponsiveAdVariants));
    }

    /**
     * @param GoogleResponsiveAdVariant ...$googleResponsiveAdVariants
     *
     * @return self
     */
    public static function fromItems(GoogleResponsiveAdVariant ...$googleResponsiveAdVariants): self
    {
        return new self(...$googleResponsiveAdVariants);
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
     * @param GoogleResponsiveAdVariant ...$googleResponsiveAdVariants
     */
    private function __construct(GoogleResponsiveAdVariant ...$googleResponsiveAdVariants)
    {
        $this->googleResponsiveAdVariants = $googleResponsiveAdVariants;
    }

    /**
     * @param GoogleResponsiveAdVariant $googleResponsiveAdVariant
     *
     * @return self
     */
    public function push(GoogleResponsiveAdVariant $googleResponsiveAdVariant): self
    {
        $copy = clone $this;
        $copy->googleResponsiveAdVariants[] = $googleResponsiveAdVariant;

        return $copy;
    }

    /**
     * @return self
     */
    public function pop(): self
    {
        $copy = clone $this;
        array_pop($copy->googleResponsiveAdVariants);

        return $copy;
    }

    /**
     * @return GoogleResponsiveAdVariant|null
     */
    public function first(): ?GoogleResponsiveAdVariant
    {
        return $this->googleResponsiveAdVariants[0] ?? null;
    }

    /**
     * @return GoogleResponsiveAdVariant|null
     */
    public function last(): ?GoogleResponsiveAdVariant
    {
        if (count($this->googleResponsiveAdVariants) === 0) {
            return null;
        }

        return $this->googleResponsiveAdVariants[count($this->googleResponsiveAdVariants) - 1];
    }

    /**
     * @param GoogleResponsiveAdVariant $googleResponsiveAdVariant
     *
     * @return bool
     */
    public function contains(GoogleResponsiveAdVariant $googleResponsiveAdVariant): bool
    {
        foreach ($this->googleResponsiveAdVariants as $existingGoogleResponsiveAdVariant) {
            if ($existingGoogleResponsiveAdVariant->equals($googleResponsiveAdVariant)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return GoogleResponsiveAdVariant[]
     */
    public function googleResponsiveAdVariants(): array
    {
        return $this->googleResponsiveAdVariants;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_map(
            static function (GoogleResponsiveAdVariant $googleResponsiveAdVariant) {
                return $googleResponsiveAdVariant->toArray();
            },
            $this->googleResponsiveAdVariants
        );
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
        return count($this->googleResponsiveAdVariants);
    }

    /**
     * Removes all empty text values from the google responsive ad variant
     *
     * @return self
     *
     * @throws AssertionFailedException
     */
    public function removeBlankText(): self
    {
        $googleResponsiveAdVariants = array_map(static function (GoogleResponsiveAdVariant $googleResponsiveAdVariant) {
            return $googleResponsiveAdVariant->removeBlankText();
        }, $this->googleResponsiveAdVariants);

        return self::fromItems(...$googleResponsiveAdVariants);
    }
}
