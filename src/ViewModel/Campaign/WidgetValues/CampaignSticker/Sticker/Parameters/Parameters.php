<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignSticker\Sticker\Parameters;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class Parameters extends AbstractValueObject
{
    /** @var Mark */
    private $mark;

    /** @var MarkAlignCollection|null */
    private $markAlign;

    /** @var Markfit|null */
    private $markfit;

    /** @var MarkWidth|null */
    private $markWidth;

    /**
     * Parameters constructor.
     *
     * @param Mark                     $mark
     * @param MarkAlignCollection|null $markAlign
     * @param Markfit|null             $markfit
     * @param MarkWidth|null           $markWidth
     */
    private function __construct(
        Mark $mark,
        ?MarkAlignCollection $markAlign,
        ?Markfit $markfit,
        ?MarkWidth $markWidth
    ) {
        $this->mark = $mark;
        $this->markAlign = $markAlign;
        $this->markfit = $markfit;
        $this->markWidth = $markWidth;
    }

    /**
     * @param array $data
     *
     * @return static
     *
     * @throws AssertionFailedException
     */
    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'mark', '', 'parameters');

        return new self(
            Mark::fromString($data['mark']),
            isset($data['mark-align']) ? MarkAlignCollection::fromArray($data['mark-align']) : null,
            isset($data['markfit']) ? Markfit::fromString($data['markfit']) : null,
            isset($data['mark-w']) ? MarkWidth::fromFloat($data['mark-w']) : null
        );
    }

    /**
     * @return Mark
     */
    public function mark(): Mark
    {
        return $this->mark;
    }

    /**
     * @return MarkAlignCollection|null
     */
    public function markAlign(): ?MarkAlignCollection
    {
        return $this->markAlign;
    }

    /**
     * @return Markfit|null
     */
    public function markfit(): ?Markfit
    {
        return $this->markfit;
    }

    /**
     * @return MarkWidth|null
     */
    public function markWidth(): ?MarkWidth
    {
        return $this->markWidth;
    }

    /**
     * @param ValueObjectInterface $valueObject
     *
     * @return bool
     */
    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $valueObject->serialize() === $this->serialize();
    }

    /**
     * Serialize object into an array or string
     *
     * @return array
     */
    public function serialize(): array
    {
        return $this->toArray();
    }

    /**
     * @param mixed $data
     *
     * @return self
     *
     * @throws AssertionFailedException
     */
    public static function deserialize($data): self
    {
        Assertion::isArray($data, null, 'image');

        return self::fromArray($data);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'mark' => $this->mark->toString(),
            'mark-align' => $this->markAlign ? $this->markAlign->toArray() : null,
            'markfit' => $this->markfit ? $this->markfit->toString() : null,
            'mark-w' => $this->markWidth ? $this->markWidth->toFloat() : null,
        ];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) json_encode($this->toArray());
    }
}
