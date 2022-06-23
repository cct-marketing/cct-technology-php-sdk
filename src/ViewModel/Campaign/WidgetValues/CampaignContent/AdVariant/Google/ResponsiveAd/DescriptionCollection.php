<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\AdVariant\Google\ResponsiveAd;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class DescriptionCollection extends AbstractValueObject
{
    /**
     * @var Description[]
     */
    private $descriptions;

    /**
     * @throws AssertionFailedException
     */
    public static function fromArray(array $descriptions): self
    {
        return new self(...array_map(static function (string $description) {
            return Description::fromString($description);
        }, $descriptions));
    }

    /**
     * @param Description ...$descriptions
     *
     * @throws AssertionFailedException
     */
    public static function fromItems(Description ...$descriptions): self
    {
        return new self(...$descriptions);
    }

    public static function emptyList(): self
    {
        return new self();
    }

    /**
     * Constructor.
     *
     * @param Description ...$descriptions
     *
     * @throws AssertionFailedException
     */
    private function __construct(Description ...$descriptions)
    {
        $this->guard($descriptions);
        $this->descriptions = $descriptions;
    }

    /**
     * @throws AssertionFailedException
     */
    public static function createEmptyValues(int $defaultShortHeadline): self
    {
        $emptyStrings = array_fill(0, $defaultShortHeadline, '');

        return self::fromArray($emptyStrings);
    }

    public function push(Description $description): self
    {
        $copy = clone $this;
        $copy->descriptions[] = $description;

        return $copy;
    }

    public function pop(): self
    {
        $copy = clone $this;
        array_pop($copy->descriptions);

        return $copy;
    }

    public function first(): ?Description
    {
        return $this->descriptions[0] ?? null;
    }

    public function last(): ?Description
    {
        if (count($this->descriptions) === 0) {
            return null;
        }

        return $this->descriptions[count($this->descriptions) - 1];
    }

    public function contains(Description $description): bool
    {
        foreach ($this->descriptions as $existingDescription) {
            if ($existingDescription->equals($description)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return Description[]
     */
    public function descriptions(): array
    {
        return $this->descriptions;
    }

    public function toArray(): array
    {
        return array_map(
            static function (Description $description) {
                return $description->toString();
            },
            $this->descriptions
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
        return count($this->descriptions);
    }

    /**
     * @param Description[] $descriptions
     *
     * @throws AssertionFailedException
     */
    private function guard(array $descriptions): void
    {
        Assertion::minCount($descriptions, 1, null, self::errorPropertyPath());
        Assertion::maxCount($descriptions, 5, null, self::errorPropertyPath());

        $stringDescriptions = array_map(
            static function (Description $description) {
                return $description->toString();
            },
            $descriptions
        );

        AssertNoDuplicates::create()->ignoreEmptyStrings()->assert(
            $stringDescriptions,
            'Descriptions should not contain duplicates',
            self::errorPropertyPath()
        );
    }

    /**
     * @throws AssertionFailedException
     */
    public function removeBlankText(): self
    {
        $descriptions = array_filter($this->descriptions, static function (Description $description) {
            return $description->notBlank();
        });

        return count($descriptions) > 0 ? self::fromItems(...$descriptions) : self::emptyList();
    }
}