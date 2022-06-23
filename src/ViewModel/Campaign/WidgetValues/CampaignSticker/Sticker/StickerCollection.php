<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignSticker\Sticker;

use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;
use function array_map;
use function array_pop;
use function json_encode;

final class StickerCollection extends AbstractValueObject
{
    /**
     * @var Sticker[]
     */
    private $stickers;

    public static function fromArray(array $stickers): self
    {
        return new self(...array_map(static function (array $sticker) {
            return Sticker::fromArray($sticker);
        }, $stickers));
    }

    /**
     * @param Sticker ...$stickers
     */
    public static function fromItems(Sticker ...$stickers): self
    {
        return new self(...$stickers);
    }

    public static function emptyList(): self
    {
        return new self();
    }

    /**
     * StickerCollection constructor.
     *
     * @param Sticker ...$stickers
     */
    private function __construct(Sticker ...$stickers)
    {
        $this->stickers = $stickers;
    }

    public function push(Sticker $sticker): self
    {
        $copy = clone $this;
        $copy->stickers[] = $sticker;

        return $copy;
    }

    public function pop(): self
    {
        $copy = clone $this;
        array_pop($copy->stickers);

        return $copy;
    }

    public function first(): ?Sticker
    {
        return $this->stickers[0] ?? null;
    }

    public function last(): ?Sticker
    {
        if (count($this->stickers) === 0) {
            return null;
        }

        return $this->stickers[count($this->stickers) - 1];
    }

    public function contains(Sticker $sticker): bool
    {
        foreach ($this->stickers as $existingSticker) {
            if ($existingSticker->equals($sticker)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return Sticker[]
     */
    public function stickers(): array
    {
        return $this->stickers;
    }

    public function toArray(): array
    {
        return array_map(static function (Sticker $sticker) {
            return $sticker->toArray();
        }, $this->stickers);
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
        return count($this->stickers);
    }
}
