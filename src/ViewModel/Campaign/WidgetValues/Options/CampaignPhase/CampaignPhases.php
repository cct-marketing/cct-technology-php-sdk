<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\Options\CampaignPhase;

use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class CampaignPhases extends AbstractValueObject
{
    /**
     * @var CampaignPhaseCollection
     */
    private $campaignPhaseCollection;

    /**
     * CampaignPhases constructor.
     *
     * @param CampaignPhaseCollection $campaignPhaseCollection
     */
    public function __construct(CampaignPhaseCollection $campaignPhaseCollection)
    {
        $this->campaignPhaseCollection = $campaignPhaseCollection;
    }

    /**
     * @param ValueObjectInterface | CampaignPhases $valueObject
     *
     * @return bool
     */
    public function equals(ValueObjectInterface $valueObject): bool
    {
        return $valueObject instanceof self;
    }

    /**
     * @return CampaignPhaseCollection|OpenHouse[]
     */
    public function getCampaignPhaseCollection()
    {
        return $this->campaignPhaseCollection;
    }

    /**
     * Serialize object into an array or string
     *
     * @return array|string
     */
    public function toArray()
    {
        return [
            'phases' => $this->campaignPhaseCollection->toArray(),
        ];
    }

    /**
     * @param mixed $data
     *
     * @return mixed
     */
    public static function fromArray($data)
    {
        $collection = CampaignPhaseCollection::fromArray($data['phases']);

        return new self($collection);
    }
}
