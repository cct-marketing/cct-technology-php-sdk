<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\Notification;

use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class Notifications extends AbstractValueObject
{
    /**
     * @var Notification|null
     */
    private $socialMediaComments;

    /**
     * @var Notification|null
     */
    private $leadCampaign;

    public static function fromArray(array $data): self
    {
        return new self(
            isset($data['social_media_comments']) ? Notification::fromArray($data['social_media_comments']) : null,
            isset($data['lead_campaign']) ? Notification::fromArray($data['lead_campaign']) : null
        );
    }

    /**
     * Notification constructor.
     */
    private function __construct(?Notification $socialMediaComments, ?Notification $leadCampaign)
    {
        $this->socialMediaComments = $socialMediaComments;
        $this->leadCampaign = $leadCampaign;
    }

    public function toArray(): array
    {
        return [
            'social_media_comments' => $this->socialMediaComments ? $this->socialMediaComments->toArray() : null,
            'lead_campaign' => $this->leadCampaign ? $this->leadCampaign->toArray() : null,
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

    public function socialMediaComments(): ?Notification
    {
        return $this->socialMediaComments;
    }

    public function leadCampaign(): ?Notification
    {
        return $this->leadCampaign;
    }
}
