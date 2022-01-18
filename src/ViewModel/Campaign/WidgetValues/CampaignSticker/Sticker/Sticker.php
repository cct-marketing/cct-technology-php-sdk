<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignSticker\Sticker;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignSticker\Sticker\Parameters\Parameters;

/**
 * PSR7 Uri interface compatible value object https://www.php-fig.org/psr/psr-7/
 */
final class Sticker extends AbstractValueObject
{
    /**
     * @var Parameters
     */
    private $parameters;

    /**
     * @var InitialPosition
     */
    private $initialPosition;

    /**
     * @var InitialPercentageSize
     */
    private $initialPercentageSize;

    /**
     * @var StickerType|null
     */
    private $stickerType;

    /**
     * Sticker constructor
     *
     * @param Parameters            $parameters
     * @param InitialPosition       $initialPosition
     * @param InitialPercentageSize $initialPercentageSize
     * @param StickerType|null      $stickerType
     */
    public function __construct(
        Parameters $parameters,
        InitialPosition $initialPosition,
        InitialPercentageSize $initialPercentageSize,
        ?StickerType $stickerType
    ) {
        $this->parameters = $parameters;
        $this->initialPosition = $initialPosition;
        $this->initialPercentageSize = $initialPercentageSize;
        $this->stickerType = $stickerType;
    }

    /**
     * @return Parameters
     */
    public function parameters(): Parameters
    {
        return $this->parameters;
    }

    /**
     * @return InitialPosition
     */
    public function initialPosition(): InitialPosition
    {
        return $this->initialPosition;
    }

    /**
     * @return InitialPercentageSize
     */
    public function initialPercentageSize(): InitialPercentageSize
    {
        return $this->initialPercentageSize;
    }

    public function stickerType(): ?StickerType
    {
        return $this->stickerType;
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
     * @param array $data
     *
     * @return Sticker
     *
     * @throws AssertionFailedException
     */
    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'parameters', null, self::errorPropertyPath());
        Assertion::keyExists($data, 'initial_position', null, self::errorPropertyPath());
        Assertion::keyExists($data, 'initial_percentage_size', null, self::errorPropertyPath());

        return new self(
            Parameters::fromArray($data['parameters']),
            new InitialPosition((int) $data['initial_position']),
            InitialPercentageSize::fromInteger((int) $data['initial_percentage_size']),
            isset($data['type']) ? StickerType::fromString($data['type']) : null
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'parameters' => $this->parameters->toArray(),
            'initial_position' => (int) $this->initialPosition->value(),
            'initial_percentage_size' => $this->initialPercentageSize->size(),
            'type' => $this->stickerType ? $this->stickerType->toString() : null,
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
