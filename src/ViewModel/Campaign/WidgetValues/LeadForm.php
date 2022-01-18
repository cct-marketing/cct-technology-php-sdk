<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class LeadForm extends AbstractValueObject
{
    /**
     * @var string
     */
    private $formId;

    /**
     * @var UuidInterface
     */
    private $uuid;

    /**
     * LeadForm constructor.
     *
     * @param UuidInterface $uuid
     * @param string        $formId
     *
     * @throws AssertionFailedException
     */
    public function __construct(UuidInterface $uuid, string $formId)
    {
        $this->guard($formId);
        $this->formId = $formId;
        $this->uuid = $uuid;
    }

    /**
     * Serialize object into an array or string
     *
     * @return array|string
     */
    public function toArray()
    {
        return [
            'uuid' => $this->uuid->toString(),
            'form_id' => $this->formId,
        ];
    }

    /**
     * @param ValueObjectInterface|LeadForm $valueObject
     *
     * @return bool
     */
    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $this->toArray() === $valueObject->toArray();
    }

    /**
     * @param mixed $data
     *
     * @return self
     *
     * @throws AssertionFailedException
     */
    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'uuid', null, 'lead_form');
        Assertion::keyExists($data, 'form_id', null, 'lead_form');
        Assertion::uuid($data['uuid'], null, 'lead_form');

        return new self(
            Uuid::fromString($data['uuid']),
            $data['form_id']
        );
    }

    /**
     * @param string $formId
     *
     * @throws AssertionFailedException
     */
    private function guard(string $formId): void
    {
        Assertion::numeric($formId, null, 'lead_form');
    }

    /**
     * @return string
     */
    public function formId(): string
    {
        return $this->formId;
    }

    /**
     * @return UuidInterface
     */
    public function uuid(): UuidInterface
    {
        return $this->uuid;
    }
}
