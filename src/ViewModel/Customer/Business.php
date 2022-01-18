<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Customer;

use Assert\Assertion;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;
use CCT\SDK\CampaignWizard\ViewModel\Customer\Logo\LogoCollection;

final class Business extends AbstractValueObject
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var LogoCollection
     */
    private $logos;

    private function __construct(string $name, LogoCollection $logos)
    {
        $this->name = $name;
        $this->logos = $logos;
    }

    /**
     * @param array $data
     *
     * @return self
     */
    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'name', null, self::errorPropertyPath());

        return new self(
            $data['name'],
            isset($data['logos']) ? LogoCollection::fromArray($data['logos']) : LogoCollection::fromItems()
        );
    }

    /**
     * @param string         $name
     * @param LogoCollection $logos
     *
     * @return self
     */
    public static function create(string $name, LogoCollection $logos): self
    {
        return new self($name, $logos);
    }

    /**
     * @return self
     */
    public static function createEmpty(): self
    {
        return new self('', LogoCollection::emptyList());
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'logos' => $this->logos->toArray(),
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

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return LogoCollection
     */
    public function logos(): LogoCollection
    {
        return $this->logos;
    }
}
