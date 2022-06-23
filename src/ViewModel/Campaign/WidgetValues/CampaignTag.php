<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class CampaignTag extends AbstractValueObject
{
    /**
     * @var string;
     */
    private $tag;

    /**
     * CampaignTag constructor.
     *
     * @throws AssertionFailedException
     */
    public function __construct(string $tag)
    {
        $this->guard($tag);
        $this->tag = $tag;
    }

    public function getTag(): string
    {
        return $this->tag;
    }

    /**
     * {@inheritdoc}
     */
    public function toString(): string
    {
        return $this->tag;
    }

    /**
     * @throws AssertionFailedException
     */
    public static function fromString(string $data): CampaignTag
    {
        return new self($data);
    }

    /**
     * @throws AssertionFailedException
     */
    private function guard(string $tag): void
    {
        Assertion::maxLength($tag, 80, null, 'campaign_tag');
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->tag;
    }

    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $this->toString() === $valueObject->toString();
    }
}
