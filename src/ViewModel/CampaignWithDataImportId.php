<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel;

use Assert\Assertion;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignPeriod;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\Product;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class CampaignWithDataImportId
{
    /**
     * @var UuidInterface
     */
    private $uuid;

    /**
     * @var string
     */
    private $orderNumber;

    /**
     * @var string
     */
    private $dataImportId;

    /**
     * @var string
     */
    private $campaignTitle;

    /**
     * @var Product
     */
    private $product;

    /**
     * @var CampaignPeriod
     */
    private $campaignPeriod;

    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'uuid');
        Assertion::keyExists($data, 'order_number');
        Assertion::keyExists($data, 'data_import_id');
        Assertion::keyExists($data, 'campaign_title');
        Assertion::keyExists($data, 'product');
        Assertion::keyExists($data, 'campaign_period');

        return new self(
            Uuid::fromString($data['uuid']),
            $data['order_number'],
            $data['data_import_id'],
            $data['campaign_title'],
            Product::fromArray($data['product']),
            CampaignPeriod::fromArray($data['campaign_period'])
        );
    }

    private function __construct(
        UuidInterface $uuid,
        string $orderNumber,
        string $dataImportId,
        string $campaignTitle,
        Product $product,
        CampaignPeriod $campaignPeriod
    ) {
        $this->uuid = $uuid;
        $this->orderNumber = $orderNumber;
        $this->dataImportId = $dataImportId;
        $this->campaignTitle = $campaignTitle;
        $this->product = $product;
        $this->campaignPeriod = $campaignPeriod;
    }

    public function toArray(): array
    {
        return [
            'uuid' => $this->uuid->toString(),
            'order_number' => $this->orderNumber,
            'data_import_id' => $this->dataImportId,
            'campaign_title' => $this->campaignTitle,
            'product' => $this->product->toArray(),
            'campaign_period' => $this->campaignPeriod->toArray(),
        ];
    }

    public function __toString(): string
    {
        return (string) json_encode($this->toArray());
    }

    public function uuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function orderNumber(): string
    {
        return $this->orderNumber;
    }

    public function dataImportId(): string
    {
        return $this->dataImportId;
    }

    public function campaignTitle(): string
    {
        return $this->campaignTitle;
    }

    public function product(): Product
    {
        return $this->product;
    }

    public function campaignPeriod(): CampaignPeriod
    {
        return $this->campaignPeriod;
    }
}
