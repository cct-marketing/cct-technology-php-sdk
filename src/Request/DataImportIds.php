<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\Request;

use Assert\Assertion;

final class DataImportIds
{
    /**
     * @var string[]
     */
    private $dataImportIds;

    public function __construct(array $dataImportIds)
    {
        Assertion::allUuid($dataImportIds, 'All ');
        $this->dataImportIds = $dataImportIds;
    }

    public function toParams(): string
    {
        return http_build_query(['data_import_ids' => $this->dataImportIds]);
    }
}
