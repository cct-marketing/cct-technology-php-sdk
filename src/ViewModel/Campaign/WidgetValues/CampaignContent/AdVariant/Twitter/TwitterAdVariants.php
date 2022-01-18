<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\AdVariant\Twitter;

use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class TwitterAdVariants extends AbstractValueObject
{
    /**
     * @var TwitterAdVariant[]
     */
    private $twitterAdVariants;

    /**
     * @param array $twitterAdVariants
     *
     * @return self
     */
    public static function fromArray(array $twitterAdVariants): self
    {
        return new self(...array_map(static function (array $twitterAdVariant) {
            return TwitterAdVariant::fromArray($twitterAdVariant);
        }, $twitterAdVariants));
    }

    /**
     * @param TwitterAdVariant ...$twitterAdVariants
     *
     * @return self
     */
    public static function fromItems(TwitterAdVariant ...$twitterAdVariants): self
    {
        return new self(...$twitterAdVariants);
    }

    /**
     * @return self
     */
    public static function emptyList(): self
    {
        return new self();
    }

    /**
     * TwitterAdVariants constructor.
     *
     * @param TwitterAdVariant ...$twitterAdVariants
     */
    private function __construct(TwitterAdVariant ...$twitterAdVariants)
    {
        $this->twitterAdVariants = $twitterAdVariants;
    }

    /**
     * @param TwitterAdVariant $twitterAdVariant
     *
     * @return self
     */
    public function push(TwitterAdVariant $twitterAdVariant): self
    {
        $copy = clone $this;
        $copy->twitterAdVariants[] = $twitterAdVariant;

        return $copy;
    }

    /**
     * @return self
     */
    public function pop(): self
    {
        $copy = clone $this;
        array_pop($copy->twitterAdVariants);

        return $copy;
    }

    /**
     * @return TwitterAdVariant|null
     */
    public function first(): ?TwitterAdVariant
    {
        return $this->twitterAdVariants[0] ?? null;
    }

    /**
     * @return TwitterAdVariant|null
     */
    public function last(): ?TwitterAdVariant
    {
        if (count($this->twitterAdVariants) === 0) {
            return null;
        }

        return $this->twitterAdVariants[count($this->twitterAdVariants) - 1];
    }

    /**
     * @param TwitterAdVariant $twitterAdVariant
     *
     * @return bool
     */
    public function contains(TwitterAdVariant $twitterAdVariant): bool
    {
        foreach ($this->twitterAdVariants as $existingTwitterAdVariant) {
            if ($existingTwitterAdVariant->equals($twitterAdVariant)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return TwitterAdVariant[]
     */
    public function twitterAdVariants(): array
    {
        return $this->twitterAdVariants;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_map(static function (TwitterAdVariant $twitterAdVariant) {
            return $twitterAdVariant->toArray();
        }, $this->twitterAdVariants);
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
        return count($this->twitterAdVariants);
    }

    /**
     * @return self
     */
    public function removeEmptyVariants(): self
    {
        $items = array_values(
            array_filter($this->twitterAdVariants, static function (TwitterAdVariant $twitterAdVariant) {
                return false === $twitterAdVariant->isEmpty();
            })
        );

        return self::fromItems(...$items);
    }
}
