<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\AdVariant\FacebookCarousel;

use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\Image\ImageCollection;

final class FacebookCarouselVariants extends AbstractValueObject
{
    /**
     * @var FacebookCarouselVariant[]
     */
    private $facebookCarouselVariants;

    public static function fromArray(array $facebookCarouselVariants): self
    {
        return new self(...array_map(static function (array $facebookCarouselVariant) {
            return FacebookCarouselVariant::fromArray($facebookCarouselVariant);
        }, $facebookCarouselVariants));
    }

    /**
     * @param FacebookCarouselVariant ...$facebookCarouselVariants
     */
    public static function fromItems(FacebookCarouselVariant ...$facebookCarouselVariants): self
    {
        return new self(...$facebookCarouselVariants);
    }

    public static function emptyList(): self
    {
        return new self();
    }

    /**
     * Constructor.
     *
     * @param FacebookCarouselVariant ...$facebookCarouselVariants
     */
    private function __construct(FacebookCarouselVariant ...$facebookCarouselVariants)
    {
        $this->facebookCarouselVariants = $facebookCarouselVariants;
    }

    public function push(FacebookCarouselVariant $facebookCarouselVariant): self
    {
        $copy = clone $this;
        $copy->facebookCarouselVariants[] = $facebookCarouselVariant;

        return $copy;
    }

    public function pop(): self
    {
        $copy = clone $this;
        array_pop($copy->facebookCarouselVariants);

        return $copy;
    }

    public function first(): ?FacebookCarouselVariant
    {
        return $this->facebookCarouselVariants[0] ?? null;
    }

    public function last(): ?FacebookCarouselVariant
    {
        if (count($this->facebookCarouselVariants) === 0) {
            return null;
        }

        return $this->facebookCarouselVariants[count($this->facebookCarouselVariants) - 1];
    }

    public function contains(FacebookCarouselVariant $facebookCarouselVariant): bool
    {
        foreach ($this->facebookCarouselVariants as $existingFacebookCarouselVariant) {
            if ($existingFacebookCarouselVariant->equals($facebookCarouselVariant)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return FacebookCarouselVariant[]
     */
    public function facebookCarouselVariants(): array
    {
        return $this->facebookCarouselVariants;
    }

    public function toArray(): array
    {
        return array_map(static function (FacebookCarouselVariant $facebookCarouselVariant) {
            return $facebookCarouselVariant->toArray();
        }, $this->facebookCarouselVariants);
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
        return count($this->facebookCarouselVariants);
    }

    /**
     * @return FacebookCarouselVariants
     */
    public function withImages(ImageCollection $images): self
    {
        $items = array_map(static function (FacebookCarouselVariant $facebookCarouselVariant) use ($images) {
            return $facebookCarouselVariant->withImages($images);
        }, $this->facebookCarouselVariants);

        return self::fromItems(...$items);
    }

    public function removeEmptyVariants(): self
    {
        $items = array_values(
            array_filter($this->facebookCarouselVariants, static function (FacebookCarouselVariant $facebookCarouselVariant) {
                return false === $facebookCarouselVariant->isEmpty();
            })
        );

        return self::fromItems(...$items);
    }
}
