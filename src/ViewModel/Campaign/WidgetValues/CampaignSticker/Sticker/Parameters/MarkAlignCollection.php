<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignSticker\Sticker\Parameters;

use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class MarkAlignCollection extends AbstractValueObject
{
    /**
     * @var MarkAlign[]
     */
    private $markAligns;

    /**
     * @param array $markAligns
     *
     * @return self
     */
    public static function fromArray(array $markAligns): self
    {
        return new self(...array_map(static function (string $markAlign) {
            return MarkAlign::fromString($markAlign);
        }, $markAligns));
    }

    /**
     * @param MarkAlign ...$markAligns
     *
     * @return self
     */
    public static function fromItems(MarkAlign ...$markAligns): self
    {
        return new self(...$markAligns);
    }

    /**
     * @return self
     */
    public static function emptyList(): self
    {
        return new self();
    }

    /**
     * StickerCollection constructor.
     *
     * @param MarkAlign ...$markAligns
     */
    private function __construct(MarkAlign ...$markAligns)
    {
        $this->markAligns = $markAligns;
    }

    /**
     * @param MarkAlign $markAlign
     *
     * @return self
     */
    public function push(MarkAlign $markAlign): self
    {
        $copy = clone $this;
        $copy->markAligns[] = $markAlign;

        return $copy;
    }

    /**
     * @return self
     */
    public function pop(): self
    {
        $copy = clone $this;
        array_pop($copy->markAligns);

        return $copy;
    }

    /**
     * @return MarkAlign|null
     */
    public function first(): ?MarkAlign
    {
        return $this->markAligns[0] ?? null;
    }

    /**
     * @return MarkAlign|null
     */
    public function last(): ?MarkAlign
    {
        if (count($this->markAligns) === 0) {
            return null;
        }

        return $this->markAligns[count($this->markAligns) - 1];
    }

    /**
     * @param MarkAlign $markAlign
     *
     * @return bool
     */
    public function contains(MarkAlign $markAlign): bool
    {
        foreach ($this->markAligns as $existingSticker) {
            if ($existingSticker->equals($markAlign)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return MarkAlign[]
     */
    public function markAligns(): array
    {
        return $this->markAligns;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_map(static function (MarkAlign $markAlign) {
            return $markAlign->toString();
        }, $this->markAligns);
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
        return count($this->markAligns);
    }
}
