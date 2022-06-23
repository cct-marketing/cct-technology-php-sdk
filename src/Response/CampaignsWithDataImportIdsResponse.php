<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\Response;

use CCT\SDK\CampaignWizard\ViewModel\CampaignWithDataImportId;

final class CampaignsWithDataImportIdsResponse
{
    /**
     * @var CampaignWithDataImportId[]
     */
    private $campaignWithDataImportIds;

    public static function fromArray(array $campaignWithDataImportIds): self
    {
        return new self(
            ...array_map(static function (array $array) {
                return CampaignWithDataImportId::fromArray($array);
            }, $campaignWithDataImportIds)
        );
    }

    public static function fromItems(CampaignWithDataImportId ...$campaignWithDataImportIds): self
    {
        return new self(...$campaignWithDataImportIds);
    }

    public static function emptyList(): self
    {
        return new self();
    }

    private function __construct(CampaignWithDataImportId ...$campaignWithDataImportIds)
    {
        $this->campaignWithDataImportIds = $campaignWithDataImportIds;
    }

    public function first(): ?CampaignWithDataImportId
    {
        return $this->campaignWithDataImportIds[0] ?? null;
    }

    /**
     * @return CampaignWithDataImportId[]
     */
    public function campaignWithDataImportIds(): array
    {
        return $this->campaignWithDataImportIds;
    }

    public function toArray(): array
    {
        return array_map(static function (CampaignWithDataImportId $array) {
            return $array->toArray();
        }, $this->campaignWithDataImportIds);
    }

    public function __toString(): string
    {
        return (string) json_encode($this->toArray());
    }

    public function count(): int
    {
        return count($this->campaignWithDataImportIds);
    }
}
