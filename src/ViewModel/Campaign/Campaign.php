<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign;

use CCT\SDK\CampaignWizard\ValueObject\DateTimeStamp;
use CCT\SDK\CampaignWizard\ValueObject\Price;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\ItemPrice\ItemizedPricing;
use CCT\SDK\CampaignWizard\ViewModel\Customer\Customer;
use CCT\SDK\CampaignWizard\ViewModel\User;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Campaign
{
    /**
     * @var UuidInterface
     */
    private $uuid;

    /**
     * @var UuidInterface
     */
    private $campaignFlowUuid;

    /**
     * @var int
     */
    private $campaignFlowVersion;

    /**
     * @var DateTimeStamp
     */
    private $createdAt;

    /**
     * @var DateTimeStamp|null
     */
    private $updatedAt;

    /**
     * @var DateTimeStamp|null
     */
    private $expiresAt;

    /**
     * @var UuidInterface | null
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
     * @var ItemizedPricing | null
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

    public function uuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function campaignFlowUuid(): UuidInterface
    {
        return $this->campaignFlowUuid;
    }

    public function getCampaignFlowVersion(): int
    {
        return $this->campaignFlowVersion;
    }

    public function createdAt(): DateTimeStamp
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?DateTimeStamp
    {
        return $this->updatedAt;
    }

    public function expiresAt(): ?DateTimeStamp
    {
        return $this->expiresAt;
    }

    public function customer(): ?Customer
    {
        return $this->customer;
    }

    public function user(): ?User
    {
        return $this->user;
    }

    public function state(): string
    {
        return $this->state;
    }

    public function totalPrice(): ?Price
    {
        return $this->totalPrice;
    }

    public function itemizedPricing(): ?ItemizedPricing
    {
        return $this->itemizedPricing;
    }

    public function dataImportId(): ?UuidInterface
    {
        return $this->dataImportId;
    }

    public function orderNumber(): ?string
    {
        return $this->orderNumber;
    }

    public function callbackUrl(): string
    {
        return $this->callbackUrl;
    }

    public function campaignWidgets(): ?CampaignWidgets
    {
        return $this->campaignWidgets;
    }

    public function metadata(): ?Metadata
    {
        return $this->metadata;
    }

    public function toArray(): array
    {
        $widgets = $this->campaignWidgets ? $this->campaignWidgets->toArray() : [];

        return [
            'uuid' => $this->uuid->toString(),
            'campaign_flow_uuid' => $this->campaignFlowUuid->toString(),
            'campaign_flow_version' => $this->campaignFlowVersion,
            'created_at' => $this->createdAt->toString(),
            'updated_at' => null,
            'expires_at' => $this->expiresAt->toString(),
            'order_number' => $this->orderNumber,
            'state' => $this->state,
            'data_import_id' => $this->dataImportId->toString(),
            'customer' => $this->customer ? $this->customer->toArray() : null,
            'total_price' => $this->totalPrice->toArray(),
            'itemized_pricing' => $this->itemizedPricing->toArray(),
            'user' => $this->user ? $this->user->toArray() : null,
            'callback_url' => $this->callbackUrl,
            'campaign_widgets' => $widgets,
            'metadata' => isset($this->metadata) ? $this->metadata->toArray() : null,
        ];
    }

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

        $self->campaignWidgets = CampaignWidgets::fromArray($data['campaign_widgets']);
        $self->metadata = isset($data['metadata']) ? Metadata::fromArray($data['metadata']) : null;

        return $self;
    }
}
