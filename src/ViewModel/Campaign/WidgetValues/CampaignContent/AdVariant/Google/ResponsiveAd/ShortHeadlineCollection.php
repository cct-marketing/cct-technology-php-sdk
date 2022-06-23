<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\AdVariant\Google\ResponsiveAd;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class ShortHeadlineCollection extends AbstractValueObject
{
    /**
     * @var ShortHeadline[]
     */
    private $shortHeadlines;

    /**
     * @throws AssertionFailedException
     */
    public static function fromArray(array $shortHeadlines): self
    {
        return new self(...array_map(static function (string $shortHeadline) {
            return ShortHeadline::fromString($shortHeadline);
        }, $shortHeadlines));
    }

    /**
     * @param ShortHeadline ...$shortHeadlines
     *
     * @throws AssertionFailedException
     */
    public static function fromItems(ShortHeadline ...$shortHeadlines): self
    {
        return new self(...$shortHeadlines);
    }

    public static function emptyList(): self
    {
        return new self();
    }

    /**
     * Constructor.
     *
     * @param ShortHeadline ...$shortHeadlines
     *
     * @throws AssertionFailedException
     */
    private function __construct(ShortHeadline ...$shortHeadlines)
    {
        $this->guard($shortHeadlines);
        $this->shortHeadlines = $shortHeadlines;
    }

    /**
     * @throws AssertionFailedException
     */
    public static function createEmptyValues(int $defaultShortHeadline): self
    {
        $emptyStrings = array_fill(0, $defaultShortHeadline, '');

        return self::fromArray($emptyStrings);
    }

    public function push(ShortHeadline $shortHeadline): self
    {
        $copy = clone $this;
        $copy->shortHeadlines[] = $shortHeadline;

        return $copy;
    }

    public function pop(): self
    {
        $copy = clone $this;
        array_pop($copy->shortHeadlines);

        return $copy;
    }

    public function first(): ?ShortHeadline
    {
        return $this->shortHeadlines[0] ?? null;
    }

    public function last(): ?ShortHeadline
    {
        if (count($this->shortHeadlines) === 0) {
            return null;
        }

        return $this->shortHeadlines[count($this->shortHeadlines) - 1];
    }

    public function contains(ShortHeadline $shortHeadline): bool
    {
        foreach ($this->shortHeadlines as $existingShortHeadline) {
            if ($existingShortHeadline->equals($shortHeadline)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return ShortHeadline[]
     */
    public function shortHeadlines(): array
    {
        return $this->shortHeadlines;
    }

    public function toArray(): array
    {
        return array_map(
            static function (ShortHeadline $shortHeadline) {
                return $shortHeadline->toString();
            },
            $this->shortHeadlines
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
        return count($this->shortHeadlines);
    }

    /**
     * @param ShortHeadline[] $shortHeadlines
     */
    private function guard(array $shortHeadlines): void
    {
        Assertion::minCount($shortHeadlines, 1, null, self::errorPropertyPath());
        Assertion::maxCount($shortHeadlines, 5, null, self::errorPropertyPath());

        $stringShortHeadlines = array_map(
            static function (ShortHeadline $shortHeadline) {
                return $shortHeadline->toString();
            },
            $shortHeadlines
        );

        AssertNoDuplicates::create()->ignoreEmptyStrings()->assert(
            $stringShortHeadlines,
            'Short headlines should not contain duplicates',
            self::errorPropertyPath()
        );
    }

    public function removeBlankText(): self
    {
        $shortHeadlines = array_filter($this->shortHeadlines, static function (ShortHeadline $shortHeadline) {
            return $shortHeadline->notBlank();
        });

        return count($shortHeadlines) > 0 ? self::fromItems(...$shortHeadlines) : self::emptyList();
    }
}
