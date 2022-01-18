<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\LocationTargeting;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class Country extends AbstractValueObject
{
    /**
     * @var string
     */
    private $name;

    /**
     * Country code in ISO 3166-2 format
     *
     * @var string
     */
    private $code;

    /**
     * Country constructor.
     *
     * @param string $name
     * @param string $code
     */
    public function __construct(string $name, string $code)
    {
        $this->guard($name, $code);
        $this->name = $name;
        $this->code = $code;
    }

    /**
     * @param ValueObjectInterface | Country $valueObject
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Serialize object into an array or string
     *
     * @return array|string
     */
    public function toArray()
    {
        return [
            'name' => $this->name,
            'code' => $this->code,
        ];
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
        Assertion::keyExists($data, 'name');
        Assertion::keyExists($data, 'code');

        return new self(
            $data['name'],
            $data['code']
        );
    }

    /**
     * @param string $name
     * @param string $code
     */
    public function guard(string $name, string $code)
    {
        Assertion::maxLength($code, 2);
        Assertion::minLength($code, 2);
    }
}
