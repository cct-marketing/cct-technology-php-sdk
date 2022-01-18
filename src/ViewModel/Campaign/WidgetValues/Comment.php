<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class Comment extends AbstractValueObject
{
    /**
     * @var string;
     */
    private $comment;

    /**
     * Comment constructor.
     *
     * @param string $comment
     *
     * @throws AssertionFailedException
     */
    public function __construct(string $comment)
    {
        $this->guard($comment);
        $this->comment = $comment;
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

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     *
     */
    public function toString(): string
    {
        return (string) $this;
    }

    /**
     * @param string $data
     *
     * @return static
     * @throws AssertionFailedException
     */
    public static function fromString(string $data): self
    {
        return new self($data);
    }

    /**
     * Guard against max length
     *
     * @param string $comment
     *
     * @throws AssertionFailedException
     */
    private function guard(string $comment): void
    {
        Assertion::maxLength($comment, 16777215, null, self::errorPropertyPath());
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->comment;
    }
}
