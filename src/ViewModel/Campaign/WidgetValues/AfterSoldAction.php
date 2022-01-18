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
     *
     * @param ActionType $actionType
     */
    private function __construct(ActionType $actionType)
    {
        $this->actionType = $actionType;
    }

    /**
     * @param array $data
     *
     * @return self
     *
     * @throws AssertionFailedException
     */
    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'action_type', null, self::errorPropertyPath());

        return new self(
            ActionType::fromString($data['action_type'])
        );
    }

    /**
     * @param ActionType $actionType
     *
     * @return self
     */
    public static function create(ActionType $actionType): self
    {
        return new self($actionType);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'action_type' => $this->actionType->toString(),
        ];
    }

    /**
     * @param ValueObjectInterface $valueObject
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
     * @return string
     */
    public function __toString(): string
    {
        return (string) json_encode($this->toArray());
    }
}
