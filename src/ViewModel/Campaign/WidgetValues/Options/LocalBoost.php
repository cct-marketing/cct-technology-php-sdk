<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\Options;

use Assert\Assertion;
use CCT\Component\ValueObject\Boolean\AbstractEnabled;
use CCT\Component\ValueObject\ValueObjectInterface;

final class LocalBoost extends AbstractEnabled
{
    /**
     * @var string|null
     */
    private $heading;

    /**
     * @var string|null
     */
    private $text;

    /**
     * @var string|null
     */
    private $description;

    /**
     * Comment constructor.
     */
    public function __construct($enabled, ?string $heading = null, ?string $text = null, ?string $description = null)
    {
        $this->apply($enabled);
        $this->guard($heading, $text, $description);
        $this->heading = $heading;
        $this->text = $text;
        $this->description = $description;
    }

    /**
     * @param ValueObjectInterface|LocalBoost $valueObject
     */
    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $this->toArray() === $valueObject->toArray();
    }

    public function getHeading(): ?string
    {
        return $this->heading;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        return [
            'enabled' => $this->enabled,
            'heading' => $this->heading,
            'text' => $this->text,
            'description' => $this->description,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function fromArray(array $data): LocalBoost
    {
        Assertion::keyExists($data, 'enabled', null, 'local_boost');

        return new self(
            $data['enabled'],
            $data['heading'] ?? null,
            $data['text'] ?? null,
            $data['description'] ?? null
        );
    }

    private function guard(?string $heading, ?string $text, ?string $description)
    {
        Assertion::nullOrMaxLength($heading, 50);
        Assertion::nullOrMaxLength($text, 200);
        Assertion::nullOrMaxLength($description, 200);
    }
}
