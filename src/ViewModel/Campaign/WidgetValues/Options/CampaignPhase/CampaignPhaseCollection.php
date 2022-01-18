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

    /**
     * @param array $openHouses
     *
     * @return self
     */
    public static function fromArray(array $openHouses): self
    {
        return new self(...array_map(static function (array $openHouse) {
            return OpenHouse::fromArray($openHouse);
        }, $openHouses));
    }

    /**
     * @param OpenHouse ...$openHouses
     *
     * @return self
     */
    public static function fromItems(OpenHouse ...$openHouses): self
    {
        return new self(...$openHouses);
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
     * @param OpenHouse ...$openHouses
     */
    private function __construct(OpenHouse ...$openHouses)
    {
        $this->openHouses = $openHouses;
    }

    /**
     * @param OpenHouse $openHouse
     *
     * @return self
     */
    public function push(OpenHouse $openHouse): self
    {
        $copy = clone $this;
        $copy->openHouses[] = $openHouse;

        return $copy;
    }

    /**
     * @return self
     */
    public function pop(): self
    {
        $copy = clone $this;
        array_pop($copy->openHouses);

        return $copy;
    }

    /**
     * @return OpenHouse|null
     */
    public function first(): ?OpenHouse
    {
        return $this->openHouses[0] ?? null;
    }

    /**
     * @return OpenHouse|null
     */
    public function last(): ?OpenHouse
    {
        if (count($this->openHouses) === 0) {
            return null;
        }

        return $this->openHouses[count($this->openHouses) - 1];
    }

    /**
     * @param OpenHouse $openHouse
     *
     * @return bool
     */
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

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_map(
            static function (OpenHouse $openHouse) {
                return $openHouse->toArray();
            },
            $this->openHouses
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
        return count($this->openHouses);
    }
}
