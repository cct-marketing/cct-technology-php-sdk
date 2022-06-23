<?php

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ValueObject\AfterSoldAction\ActionType;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class AfterSoldAction extends AbstractValueObject
{
    /**
     * @var ActionType
     */
    private $actionType;

    /**
     * AfterSoldAction constructor.
     */
    private function __construct(ActionType $actionType)
    {
        $this->actionType = $actionType;
    }

    /**
     * @throws AssertionFailedException
     */
    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'action_type', null, self::errorPropertyPath());

        return new self(
            ActionType::fromString($data['action_type'])
        );
    }

    public static function create(ActionType $actionType): self
    {
        return new self($actionType);
    }

    public function toArray(): array
    {
        return [
            'action_type' => $this->actionType->toString(),
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
}
