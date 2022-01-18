<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues;

use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\Component\ValueObject\Web\Url;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

final class LandingPage extends AbstractValueObject
{
    /**
     * @var Url
     */
    private $url;

    /**
     * @param string $url
     *
     * @return self
     */
    public static function fromString(string $url): self
    {
        return new self(new Url($url));
    }

    /**
     * Landing Page constructor.
     *
     * @param Url $url
     */
    private function __construct(Url $url)
    {
        $this->url = $url;
    }

    /**
     * @return Url
     */
    public function url(): Url
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return (string) $this->url;
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

        return $this->url->equals($valueObject->url());
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->url;
    }
}
