<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\Options\CampaignPhase;

use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class CampaignPhaseCollection extends AbstractValueObject
{
    /**
     * @var OpenHouse[]
     */
    private $openHouses;

    public static function fromArray(array $openHouses): self
    {
        return new self(...array_map(static function (array $openHouse) {
            return OpenHouse::fromArray($openHouse);
        }, $openHouses));
    }

    /**
     * @param OpenHouse ...$openHouses
     */
    public static function fromItems(OpenHouse ...$openHouses): self
    {
        return new self(...$openHouses);
    }

    public static function emptyList(): self
    {
        return new self();
    }

    /**
     * Constructor.
     *
     * @param OpenHouse ...$openHouses
     */
    private function __construct(OpenHouse ...$openHouses)
    {
        $this->openHouses = $openHouses;
    }

    public function push(OpenHouse $openHouse): self
    {
        $copy = clone $this;
        $copy->openHouses[] = $openHouse;

        return $copy;
    }

    public function pop(): self
    {
        $copy = clone $this;
        array_pop($copy->openHouses);

        return $copy;
    }

    public function first(): ?OpenHouse
    {
        return $this->openHouses[0] ?? null;
    }

    public function last(): ?OpenHouse
    {
        if (count($this->openHouses) === 0) {
            return null;
        }

        return $this->openHouses[count($this->openHouses) - 1];
    }

    public function contains(OpenHouse $openHouse): bool
    {
        foreach ($this->openHouses as $existingOpenHouse) {
            if ($existingOpenHouse->equals($openHouse)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return OpenHouse[]
     */
    public function openHouses(): array
    {
        return $this->openHouses;
    }

    public function toArray(): array
    {
        return array_map(
            static function (OpenHouse $openHouse) {
                return $openHouse->toArray();
            },
            $this->openHouses
        );
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
        return count($this->openHouses);
    }
}
