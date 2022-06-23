<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\Options;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ValueObject\Enabled;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class SaveAsTemplate extends AbstractValueObject
{
    /**
     * @var string|null
     */
    private $name;

    /**
     * @var Enabled
     */
    private $enabled;

    /**
     * SaveAsTemplate constructor.
     *
     * @throws AssertionFailedException
     */
    private function __construct(Enabled $enabled, ?string $name = null)
    {
        $this->guard($enabled, $name);

        $this->enabled = $enabled;
        $this->name = $name;
    }

    /**
     * @throws AssertionFailedException
     */
    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'enabled', '', self::errorPropertyPath());
        Assertion::keyExists($data, 'name', '', self::errorPropertyPath());

        return new self(
            Enabled::fromMixed($data['enabled']),
            $data['name']
        );
    }

    public function toArray(): array
    {
        return [
            'enabled' => $this->enabled->toBool(),
            'name' => $this->name,
        ];
    }

    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $this->toArray() === $valueObject->toArray();
    }

    public function __toString(): string
    {
        return (string) json_encode($this->toArray());
    }

    /**
     * @throws AssertionFailedException
     */
    private function guard(Enabled $enabled, ?string $name): void
    {
        if ($enabled->isEnabled()) {
            Assertion::notBlank($name, null, self::errorPropertyPath());
            Assertion::minLength($name, 1, null, self::errorPropertyPath());
            Assertion::maxLength($name, 255, null, self::errorPropertyPath());

            return;
        }

        Assertion::nullOrMaxLength($name, 255, null, self::errorPropertyPath());
    }

    public function isEnabled(): bool
    {
        return $this->enabled->isEnabled();
    }

    public function name(): ?string
    {
        return $this->name;
    }
}
