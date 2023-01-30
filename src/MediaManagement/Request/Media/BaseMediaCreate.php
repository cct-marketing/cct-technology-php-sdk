<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\Request\Media;

use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;
use CCT\SDK\MediaManagement\ViewModel\MediaType;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class BaseMediaCreate extends AbstractMulti
{
    public function __construct(
        public readonly ?string $id,
        public readonly ?string $name,
        public readonly ?string $description,
        public readonly ?bool $private,
        public readonly ?MediaType $type,
        public readonly ?string $predefinedName
    ) {
    }

    public function toMultipart(): array
    {
        $multipartData = [];

        foreach ($this->toArray() as $field => $value) {
            if (null === $value) {
                continue;
            }

            if (is_array($value)) {
                foreach ($value as $item) {
                    foreach ($item as $propertyName => $subValue) {
                        if (null === $subValue) {
                            continue;
                        }
                        $multipartData[] = [
                            'name' => sprintf('media[%s][][%s]', $field, $propertyName),
                            'contents' => $subValue,
                        ];
                    }
                }

                continue;
            }

            $multipartData[] = [
                'name' => sprintf('media[%s]', $field),
                'contents' => $value,
            ];
        }

        return $multipartData;
    }
}
