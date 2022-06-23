<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel;

use Assert\Assertion;

final class User
{
    /**
     * External Reference Id
     *
     * @var string
     */
    private $referenceIdentifier;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $email;

    public function __construct(string $name, string $referenceIdentifier, ?string $email = null)
    {
        $this->name = $name;
        $this->referenceIdentifier = $referenceIdentifier;
        $this->email = $email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getReferenceIdentifier(): string
    {
        return $this->referenceIdentifier;
    }

    public function email(): ?string
    {
        return $this->email;
    }

    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'name', null, 'user');
        Assertion::keyExists($data, 'reference_identifier', null, 'user');

        return new self(
            $data['name'],
            $data['reference_identifier'],
            $data['email'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'reference_identifier' => $this->referenceIdentifier,
            'email' => $this->email,
        ];
    }

    public function __toString(): string
    {
        return (string) json_encode($this->toArray());
    }
}
