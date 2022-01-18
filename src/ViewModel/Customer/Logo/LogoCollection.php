<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Customer\Logo;

use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class LogoCollection extends AbstractValueObject
{
    /**
     * @var Logo[]
     */
    private $logos;

    /**
     * @param array $logos
     *
     * @return self
     */
    public static function fromArray(array $logos): self
    {
        return new self(...array_map(static function (array $logo) {
            return Logo::fromArray($logo);
        }, $logos));
    }

    /**
     * @param Logo ...$logos
     *
     * @return self
     */
    public static function fromItems(Logo ...$logos): self
    {
        return new self(...$logos);
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
     * @param Logo ...$logos
     */
    private function __construct(Logo ...$logos)
    {
        $this->logos = $logos;
    }

    /**
     * @param Logo $logo
     *
     * @return self
     */
    public function push(Logo $logo): self
    {
        $copy = clone $this;
        $copy->logos[] = $logo;

        return $copy;
    }

    /**
     * @return self
     */
    public function pop(): self
    {
        $copy = clone $this;
        array_pop($copy->logos);

        return $copy;
    }

    /**
     * @return Logo|null
     */
    public function first(): ?Logo
    {
        return $this->logos[0] ?? null;
    }

    /**
     * @return Logo|null
     */
    public function last(): ?Logo
    {
        if (count($this->logos) === 0) {
            return null;
        }

        return $this->logos[count($this->logos) - 1];
    }

    /**
     * @param Logo $logo
     *
     * @return bool
     */
    public function contains(Logo $logo): bool
    {
        foreach ($this->logos as $existingLogo) {
            if ($existingLogo->equals($logo)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return Logo[]
     */
    public function logos(): array
    {
        return $this->logos;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_map(
            static function (Logo $logo) {
                return $logo->toArray();
            },
            $this->logos
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
        return count($this->logos);
    }
}
