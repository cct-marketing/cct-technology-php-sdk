<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\Request\Context;

use Assert\Assertion;
use CCT\SDK\MediaManagement\ViewModel\ValueObjectInterface;

final class Context implements ValueObjectInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * Context constructor.
     */
    private function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'name', null, '');

        return new self($data['name']);
    }

    public static function create(string $name): self
    {
        return new self($name);
    }

    public function toArray(): array
    {
        return [
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

    public function name(): string
    {
        return $this->name;
    }
}
