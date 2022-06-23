<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Customer;

use Assert\Assertion;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class Customer
{
    /**
     * Order code prefix
     *
     * @var string
     */
    private $codePrefix;

    /**
     * External Reference Id
     *
     * @var string
     */
    private $referenceIdentifier;

    /**
     * Customer name
     *
     * @var string
     */
    private $name;

    /**
     * @var bool
     */
    private $facebookPageAccessEnabled;

    /**
     * Use string to store Facebook account id as facebook id may grow bigger than an int can handle
     *
     * @var string | null
     */
    private $facebookAccountId;

    /**
     * @var string|null
     */
    private $supportEmail;

    /**
     * @var ContactCollection|null
     */
    private $contacts = null;

    /**
     * @var string|null
     */
    private $agencyIdentifier;

    /**
     * @var Business|null
     */
    private $business = null;

    /**
     * @var UuidInterface
     */
    private $uuid;

    /**
     * @var UuidInterface|null
     */
    private $agencyUuid;

    private function __construct(
        UuidInterface $uuid,
        ?UuidInterface $agencyUuid,
        string $codePrefix,
        string $name,
        string $referenceIdentifier,
        bool $facebookPageAccessEnabled,
        ?string $facebookAccountId,
        ?string $supportEmail,
        ?ContactCollection $contacts,
        ?string $agencyIdentifier,
        ?Business $business
    ) {
        $this->name = $name;
        $this->codePrefix = $codePrefix;
        $this->referenceIdentifier = $referenceIdentifier;
        $this->facebookPageAccessEnabled = $facebookPageAccessEnabled;
        $this->facebookAccountId = $facebookAccountId;
        $this->supportEmail = $supportEmail;
        $this->contacts = $contacts;
        $this->agencyIdentifier = $agencyIdentifier;
        $this->business = $business;
        $this->uuid = $uuid;
        $this->agencyUuid = $agencyUuid;
    }

    public static function create(
        UuidInterface $uuid,
        ?UuidInterface $agencyUuid,
        string $codePrefix,
        string $name,
        string $referenceIdentifier,
        ?bool $facebookPageAccessEnabled = null,
        ?string $facebookAccountId = null,
        ?string $supportEmail = null,
        ?ContactCollection $contacts = null,
        ?string $agencyIdentifier = null,
        ?Business $business = null
    ): Customer {
        return new self(
            $uuid,
            $agencyUuid,
            $codePrefix,
            $name,
            $referenceIdentifier,
            $facebookPageAccessEnabled ?? false,
            $facebookAccountId,
            $supportEmail,
            $contacts,
            $agencyIdentifier,
            $business
        );
    }

    public function hasFacebookPageAccessEnabled(): bool
    {
        return $this->facebookPageAccessEnabled;
    }

    public function codePrefix(): string
    {
        return $this->codePrefix;
    }

    public function referenceIdentifier(): string
    {
        return $this->referenceIdentifier;
    }

    public function nme(): string
    {
        return $this->name;
    }

    public function facebookAccountId(): ?string
    {
        return $this->facebookAccountId;
    }

    public function supportEmail(): ?string
    {
        return $this->supportEmail;
    }

    public function contacts(): ?string
    {
        return $this->contacts;
    }

    public function agencyIdentifier(): ?string
    {
        return $this->agencyIdentifier ?? null;
    }

    public function business(): ?string
    {
        return $this->business;
    }

    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'code_prefix', null, 'customer');
        Assertion::keyExists($data, 'name', null, 'customer');
        Assertion::keyExists($data, 'reference_identifier', null, 'customer');

        return new self(
            Uuid::fromString($data['uuid']),
            isset($data['agency_uuid']) ? Uuid::fromString($data['agency_uuid']) : null,
            $data['code_prefix'],
            $data['name'],
            $data['reference_identifier'],
            $data['facebook_page_access_enabled'] ?? false,
            $data['facebook_account_id'] ?? null,
            $data['support_email'] ?? null,
            isset($data['contacts'])
                ? ContactCollection::fromArray($data['contacts']) : null,
            $data['agency_identifier'] ?? null,
            isset($data['business'])
                ? Business::fromArray($data['business']) : null
        );
    }

    public function toArray(): array
    {
        return [
            'uuid' => $this->uuid->toString(),
            'agency_uuid' => $this->agencyUuid->toString(),
            'code_prefix' => $this->codePrefix,
            'name' => $this->name,
            'reference_identifier' => $this->referenceIdentifier,
            'facebook_page_access_enabled' => $this->facebookPageAccessEnabled,
            'facebook_account_id' => $this->facebookAccountId,
            'support_email' => $this->supportEmail,
            'contacts' => $this->contacts ? $this->contacts->toArray() : null,
            'agency_identifier' => $this->agencyIdentifier,
            'business' => $this->business ? $this->business->toArray() : null,
        ];
    }

    public function __toString(): string
    {
        return (string) json_encode($this->toArray());
    }
}
