<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\AdVariant\Google\ResponsiveAd;

use Assert\Assertion;
use Assert\AssertionFailedException;

final class AssertNoDuplicates
{
    /**
     * @var bool
     */
    private $ignoreEmptyStrings = false;

    /**
     * @return self
     */
    public static function create(): self
    {
        return new self();
    }

    /**
     * Empty strings will not be checked in assertion. This means if you have multiple empty strings it will
     * still be valid
     *
     * @return self
     */
    public function ignoreEmptyStrings(): self
    {
        $this->ignoreEmptyStrings = true;

        return $this;
    }

    /**
     * Empty strings will be checked in assertion. This means if you have multiple empty strings it will be invalid
     *
     * @return self
     */
    public function checkEmptyStrings(): self
    {
        $this->ignoreEmptyStrings = false;

        return $this;
    }

    /**
     * @param array       $array
     * @param string|null $message
     * @param string      $propertyPath
     *
     * @throws AssertionFailedException
     */
    public function assert(array $array, ?string $message, string $propertyPath): void
    {
        if (true === $this->ignoreEmptyStrings) {
            $array = $this->removeExtraEmpties($array);
        }

        Assertion::same(
            count($array),
            count(array_unique($array)),
            $message ?? 'Array should not contain duplicates.',
            $propertyPath
        );
    }

    /**
     * @param array $array
     *
     * @return array
     */
    private function removeExtraEmpties(array $array): array
    {
        $withOneEmpty = [];
        foreach ($array as $data) {
            if ($data === '' && !in_array('', $withOneEmpty, true)) {
                continue;
            }

            $withOneEmpty[] = $data;
        }

        return $withOneEmpty;
    }
}
