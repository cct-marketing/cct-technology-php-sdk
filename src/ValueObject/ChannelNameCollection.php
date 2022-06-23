<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ValueObject;

use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class ChannelNameCollection extends AbstractValueObject
{
    /**
     * @var ChannelName[]
     */
    private $channelNames;

    public static function fromArray(array $channelNames): self
    {
        return new self(...array_map(static function (string $channelName) {
            return ChannelName::fromString($channelName);
        }, $channelNames));
    }

    /**
     * @param ChannelName ...$channelNames
     */
    public static function fromItems(ChannelName ...$channelNames): self
    {
        return new self(...$channelNames);
    }

    public static function emptyList(): self
    {
        return new self();
    }

    /**
     * Constructor.
     *
     * @param ChannelName ...$channelNames
     */
    private function __construct(ChannelName ...$channelNames)
    {
        $this->channelNames = $channelNames;
    }

    public function push(ChannelName $channelName): self
    {
        $copy = clone $this;
        $copy->channelNames[] = $channelName;

        return $copy;
    }

    public function pop(): self
    {
        $copy = clone $this;
        array_pop($copy->channelNames);

        return $copy;
    }

    public function first(): ?ChannelName
    {
        return $this->channelNames[0] ?? null;
    }

    public function last(): ?ChannelName
    {
        if (count($this->channelNames) === 0) {
            return null;
        }

        return $this->channelNames[count($this->channelNames) - 1];
    }

    public function contains(ChannelName $channelName): bool
    {
        foreach ($this->channelNames as $existingChannelName) {
            if ($existingChannelName->equals($channelName)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return ChannelName[]
     */
    public function channelNames(): array
    {
        return $this->channelNames;
    }

    public function toArray(): array
    {
        return array_map(
            static function (ChannelName $channelName) {
                return $channelName->toString();
            },
            $this->channelNames
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
        return count($this->channelNames);
    }
}
