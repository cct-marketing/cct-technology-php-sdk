<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign;

use CCT\Component\ValueObject\Helper\ClassComparison;
use CCT\Component\ValueObject\ValueObjectInterface;
use ReflectionClass;

abstract class AbstractValueObject implements ValueObjectInterface
{
    /**
     * @param ValueObjectInterface $valueObject
     *
     * @return bool
     */
    abstract public function equals(ValueObjectInterface $valueObject):bool;

    /**
     * {@inheritdoc}
     */
    public function sameValueAs(ValueObjectInterface $valueObject): bool
    {
        return !(false === ClassComparison::classEquals($this, $valueObject));
    }

    /**
     * @return string
     */
    protected static function errorPropertyPath(): string
    {
        try {
            $shortName = (new ReflectionClass(static::class))->getShortName();
        } catch (\ReflectionException $exception){
            $shortName = substr(strrchr(__CLASS__, "\\"), 1);
        }

        $shortNameUnderScored = preg_replace('/([A-Z])/', '_$1', $shortName);

        return strtolower($shortNameUnderScored ?? '');
    }
}
