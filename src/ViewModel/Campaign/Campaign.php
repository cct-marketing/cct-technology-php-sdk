<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign;

use CCT\SDK\CampaignWizard\ValueObject\DateTimeStamp;
use CCT\SDK\CampaignWizard\ValueObject\Price;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\ItemPrice\ItemizedPricing;
use CCT\SDK\CampaignWizard\ViewModel\Customer\Customer;
use CCT\SDK\CampaignWizard\ViewModel\User;
use DateTimeInterface;
use Ramsey\Uuid\Uuid;

class Campaign
{
    /**
     * @var string
     */
    private $uuid;

    /**
     * @var string
     */
    private $campaignFlowUuid;

    /**
     * @var int
     */
    private $campaignFlowVersion;

    /**
     * @var DateTimeInterface
     */
    private $createdAt;

    /**
     * @var DateTimeInterface|null
     */
    private $updatedAt;

    /**
     * @var DateTimeInterface|null
     */
    private $expiresAt;

    /**
     * @var string | null
     */
    private $dataImportId;

    /**
     * @var string
     */
    private $state;

    /**
     * @var Customer | null
     */
    private $customer;

    /**
     * @var User | null
     */
    private $user;

    /**
     * @var Price | null
     */
    private $totalPrice;

    /**
     * @var array | null
     */
    private $itemizedPricing;

    /**
     * @var string | null
     */
    private $orderNumber;

    /**
     * @var string
     */
    private $callbackUrl;

    /**
     * @var CampaignWidgets | null
     */
    private $campaignWidgets;

    /**
     * @var Metadata | null
     */
    private $metadata;

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function getCampaignFlowUuid(): string
    {
        return $this->campaignFlowUuid;
    }

    /**
     * @return int
     */
    public function getCampaignFlowVersion(): int
    {
        return $this->campaignFlowVersion;
    }

    /**
     * @return DateTimeInterface
     */
    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getExpiresAt(): ?DateTimeInterface
    {
        return $this->expiresAt;
    }

    /**
     * @return Customer|null
     */
    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @return Price|null
     */
    public function getTotalPrice(): ?Price
    {
        return $this->totalPrice;
    }

    /**
     * @return array|null
     */
    public function getItemizedPricing(): ?array
    {
        return $this->itemizedPricing;
    }

    /**
     * @return null|string
     */
    public function getDataImportId(): ?string
    {
        return $this->dataImportId;
    }

    /**
     * @return null|string
     */
    public function getOrderNumber(): ?string
    {
        return $this->orderNumber;
    }

    /**
     * @return string
     */
    public function getCallbackUrl(): string
    {
        return $this->callbackUrl;
    }

    /**
     * @return CampaignWidgets|null
     */
    public function getCampaignWidgets(): ?CampaignWidgets
    {
        return $this->campaignWidgets;
    }


    /**
     * @return Metadata|null
     */
    public function metadata(): ?Metadata
    {
        return $this->metadata;
    }

    /**
     * Serialize object into an array or string
     *
     * @return array
     */
    public function toArray(): array
    {
        $widgets = $this->campaignWidgets ? $this->campaignWidgets->toArray() : [];

        return [
            'uuid' => $this->uuid,
            'campaign_flow_uuid' => $this->campaignFlowUuid,
            'campaign_flow_version' => $this->campaignFlowVersion,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
            'expires_at' => $this->expiresAt,
            'order_number' => $this->orderNumber,
            'state' => $this->state,
            'data_import_id' => $this->dataImportId,
            'customer' => $this->customer ? $this->customer->toArray() : null,
            'total_price' => $this->totalPrice,
            'itemized_pricing' => $this->itemizedPricing,
            'user' => $this->user ? $this->user->toArray() : null,
            'callback_url' => $this->callbackUrl,
            'campaign_widgets' => $widgets,
            'metadata' => isset($this->metadata) ? $this->metadata->toArray() : null,
        ];
    }

    /**
     * @param array $data
     *
     * @return self
     */
    public static function fromArray(array $data): self
    {
        $self = new self();

        $self->uuid = Uuid::fromString($data['uuid']);
        $self->campaignFlowUuid = Uuid::fromString($data['campaign_flow_uuid']);
        $self->campaignFlowVersion = (int) $data['campaign_flow_version'];
        $self->createdAt = DateTimeStamp::fromString($data['created_at']);
        $self->updatedAt = isset($data['updated_at']) ? DateTimeStamp::fromString($data['updated_at']) : null;
        $self->expiresAt = DateTimeStamp::fromString($data['expires_at']);
        $self->orderNumber = $data['order_number'] ?? null;
        $self->state = $data['state'];
        $self->dataImportId = isset($data['data_import_id'])
            ? Uuid::fromString($data['data_import_id']) : null;
        $self->customer = isset($data['customer']) ? Customer::fromArray($data['customer']) : null;
        $self->totalPrice = isset($data['total_price']) ? Price::fromArray($data['total_price']) : null;
        $self->itemizedPricing = isset($data['itemized_pricing'])
            ? ItemizedPricing::fromArray($data['itemized_pricing']) : null;
        $self->user = isset($data['user']) ? User::fromArray($data['user']) : null;
        $self->callbackUrl = $data['callback_url'];

        $self->campaignWidgets = CampaignWidgets::fromArray($data);
        $self->metadata = isset($data['metadata']) ? Metadata::fromArray($data['metadata']) : null;

        return $self;
    }
}
