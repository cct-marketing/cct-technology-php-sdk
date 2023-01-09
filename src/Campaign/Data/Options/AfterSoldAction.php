<?php

namespace CCT\SDK\Campaign\Data\Options;

use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class AfterSoldAction extends AbstractMulti
{
    private function __construct(public readonly ActionType $actionType)
    {
    }

    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'action_type', self::errorPropertyPath());

        return new self(
            ActionType::from($data['action_type'])
        );
    }

    public static function create(ActionType $actionType): self
    {
        return new self($actionType);
    }

    public function toArray(): array
    {
        return [
            'action_type' => $this->actionType->value,
        ];
    }
}
