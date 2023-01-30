<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\Request\Media;

use CCT\SDK\Infrastructure\Assert\Assertion;
use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapFrom;

final class UploadMedia extends AbstractMulti implements CreateMediaInterface
{
    public function __construct(
        #[MapFrom(['id', 'name', 'description', 'private', 'type', 'predefined_name'])]
        public readonly BaseMediaCreate $baseMediaCreate,
        public readonly mixed $fileResource,
        public readonly string $fileName
    ) {
        Assertion::isResource($fileResource);
    }

    public function toMultipart(): array
    {
        return array_merge(
            $this->baseMediaCreate->toMultipart(),
            [[
                'name' => 'media[file]',
                'contents' => $this->fileResource,
                'filename' => $this->fileName,
            ]]
        );
    }
}
