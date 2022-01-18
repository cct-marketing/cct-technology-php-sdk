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
     * @param string $tag
     *
     * @throws AssertionFailedException
     */
    public function __construct(string $tag)
    {
        $this->guard($tag);
        $this->tag = $tag;
    }

    /**
     * @return string
     */
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
     * @param string $data
     *
     * @return CampaignTag
     *
     * @throws AssertionFailedException
     */
    public static function fromString(string $data): CampaignTag
    {
        return new self($data);
    }

    /**
     * @param string $tag
     *
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

        return $this->toString() === $valueObject->toString();
    }
}
