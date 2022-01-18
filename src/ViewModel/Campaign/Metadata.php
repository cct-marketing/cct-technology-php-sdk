<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign;

use CCT\Component\ValueObject\ValueObjectInterface;

final class Metadata extends AbstractValueObject
{
    /**
     * @var string|null
     */
    private $orderNumber;

    /**
     * @var array|null
     */
    private $agent;

    /**
     * @var array|null
     */
    private $genericMetadataCollection;

    /**
     * @var string|null
     */
    private $facebookImageRatio;

    /**
     * @var string|null
     */
    private $previousDataImportIdentifier;

    public static function fromArray(array $data): self
    {
        return new self(
            $data['order_number'] ?? null,
            $data['agent'] ?? null,
            $data['generic'] ?? null,
            $data['facebook_image_ratio'] ?? null,
            $data['previous_data_import_identifier'] ?? null
        );
    }

    private function __construct(
        ?string $orderNumber,
        ?array $agent,
        ?array $genericMetadataCollection,
        ?string $facebookImageRatio,
        ?string $previousDataImportIdentifier
    ) {
        $this->orderNumber = $orderNumber;
        $this->agent = $agent;
        $this->genericMetadataCollection = $genericMetadataCollection;
        $this->facebookImageRatio = $facebookImageRatio;
        $this->previousDataImportIdentifier = $previousDataImportIdentifier;
    }

    public function toArray(): array
    {
        return [
            'order_number' => $this->orderNumber ,
            'agent' => $this->agent,
            'generic' => $this->genericMetadataCollection,
            'facebook_image_ratio' => $this->facebookImageRatio,
            'previous_data_import_identifier' => $this->previousDataImportIdentifier
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

    public function agent(): ?array
    {
        return $this->agent;
    }


    public function facebookImageRatio(): ?string
    {
        return $this->facebookImageRatio;
    }

    public function orderNumber(): ?string
    {
        return $this->orderNumber;
    }

    public function genericMetadataCollection(): ?array
    {
        return $this->genericMetadataCollection;
    }

    public function previousDataImportIdentifier(): ?string
    {
        return $this->previousDataImportIdentifier;
    }
}
