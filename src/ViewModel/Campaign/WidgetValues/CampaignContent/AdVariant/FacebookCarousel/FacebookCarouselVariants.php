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

    /**
     * @param array $facebookCarouselVariants
     *
     * @return self
     */
    public static function fromArray(array $facebookCarouselVariants): self
    {
        return new self(...array_map(static function (array $facebookCarouselVariant) {
            return FacebookCarouselVariant::fromArray($facebookCarouselVariant);
        }, $facebookCarouselVariants));
    }

    /**
     * @param FacebookCarouselVariant ...$facebookCarouselVariants
     *
     * @return self
     */
    public static function fromItems(FacebookCarouselVariant ...$facebookCarouselVariants): self
    {
        return new self(...$facebookCarouselVariants);
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
     * @param FacebookCarouselVariant ...$facebookCarouselVariants
     */
    private function __construct(FacebookCarouselVariant ...$facebookCarouselVariants)
    {
        $this->facebookCarouselVariants = $facebookCarouselVariants;
    }

    /**
     * @param FacebookCarouselVariant $facebookCarouselVariant
     *
     * @return self
     */
    public function push(FacebookCarouselVariant $facebookCarouselVariant): self
    {
        $copy = clone $this;
        $copy->facebookCarouselVariants[] = $facebookCarouselVariant;

        return $copy;
    }

    /**
     * @return self
     */
    public function pop(): self
    {
        $copy = clone $this;
        array_pop($copy->facebookCarouselVariants);

        return $copy;
    }

    /**
     * @return FacebookCarouselVariant|null
     */
    public function first(): ?FacebookCarouselVariant
    {
        return $this->facebookCarouselVariants[0] ?? null;
    }

    /**
     * @return FacebookCarouselVariant|null
     */
    public function last(): ?FacebookCarouselVariant
    {
        if (count($this->facebookCarouselVariants) === 0) {
            return null;
        }

        return $this->facebookCarouselVariants[count($this->facebookCarouselVariants) - 1];
    }

    /**
     * @param FacebookCarouselVariant $facebookCarouselVariant
     *
     * @return bool
     */
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

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_map(static function (FacebookCarouselVariant $facebookCarouselVariant) {
            return $facebookCarouselVariant->toArray();
        }, $this->facebookCarouselVariants);
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
        return count($this->facebookCarouselVariants);
    }

    /**
     * @param ImageCollection $images
     *
     * @return FacebookCarouselVariants
     */
    public function withImages(ImageCollection $images): self
    {
        $items = array_map(static function (FacebookCarouselVariant $facebookCarouselVariant) use ($images) {
            return $facebookCarouselVariant->withImages($images);
        }, $this->facebookCarouselVariants);

        return self::fromItems(...$items);
    }

    /**
     * @return self
     */
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
