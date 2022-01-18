<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Customer;

use Assert\Assertion;
use Assert\AssertionFailedException;

final class Customer
{
    /**
     * @var mixed
     */
    private $id;

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
     * Customer constructor.
     *
     * @param string                 $codePrefix
     * @param string                 $name
     * @param string                 $referenceIdentifier
     * @param bool                   $facebookPageAccessEnabled
     * @param string|null            $facebookAccountId
     * @param string|null            $supportEmail
     * @param ContactCollection|null $contacts
     * @param string|null            $agencyIdentifier
     * @param Business|null          $business
     */
    private function __construct(
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
    }

    /**
     * Factory method to create customer
     *
     * @param string                 $codePrefix
     * @param string                 $name
     * @param string                 $referenceIdentifier
     * @param bool|null              $facebookPageAccessEnabled
     * @param string|null            $facebookAccountId
     * @param string|null            $supportEmail
     * @param ContactCollection|null $contacts
     * @param string|null            $agencyIdentifier
     *
     * @param Business|null          $business
     *
     * @return Customer
     */
    public static function create(
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

    /**
     * @return bool
     */
    public function hasFacebookPageAccessEnabled(): bool
    {
        return $this->facebookPageAccessEnabled;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCodePrefix(): string
    {
        return $this->codePrefix;
    }

    /**
     * @return string
     */
    public function getReferenceIdentifier(): string
    {
        return $this->referenceIdentifier;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getFacebookAccountId(): ?string
    {
        return $this->facebookAccountId;
    }

    /**
     * @return string|null
     */
    public function getSupportEmail(): ?string
    {
        return $this->supportEmail;
    }

    /**
     * @return string|null
     */
    public function getContacts(): ?string
    {
        return $this->contacts;
    }

    /**
     * @return string|null
     */
    public function agencyIdentifier(): ?string
    {
        return $this->agencyIdentifier ?? null;
    }

    /**
     * @return string|null
     */
    public function business(): ?string
    {
        return $this->business;
    }

    /**
     * @param array $data
     *
     * @return self
     *
     * @throws AssertionFailedException
     */
    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'code_prefix', null, 'customer');
        Assertion::keyExists($data, 'name', null, 'customer');
        Assertion::keyExists($data, 'reference_identifier', null, 'customer');

        return new self(
            $data['code_prefix'],
            $data['name'],
            $data['reference_identifier'],
            $data['facebook_page_access_enabled'] ?? false,
            $data['facebook_account_id'] ?? null,
            $data['support_email']?? null,
            isset($data['contacts'])
                ? ContactCollection::fromArray($data['contacts']) : null,
                $data['agency_identifier']?? null,
            isset($data['business'])
                ? Business::fromArray($data['business']) : null
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
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

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) json_encode($this->toArray());
    }
}
