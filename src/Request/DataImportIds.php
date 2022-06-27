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
        $params = array_map(static function (string $dataImportId) {
            return sprintf('data_import_ids[]=%s', $dataImportId);
        }, $this->dataImportIds);

        return implode('&', $params);
    }
}
