<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\ViewModel\Traits;

use CCT\SDK\MediaManagement\ViewModel\ContextCollection;
use CCT\SDK\MediaManagement\ViewModel\MediaType;
use CCT\SDK\MediaManagement\ViewModel\Status;

trait BaseMediaGettersTrait
{
    public function id(): string
    {
        return $this->baseMedia->id;
    }

    public function name(): ?string
    {
        return $this->baseMedia->name;
    }

    public function description(): ?string
    {
        return $this->baseMedia->description;
    }

    public function private(): bool
    {
        return $this->baseMedia->private;
    }

    public function extension(): ?string
    {
        return $this->baseMedia->extension;
    }

    public function status(): ?Status
    {
        return $this->baseMedia->status;
    }

    public function external(): ?bool
    {
        return $this->baseMedia->external;
    }

    public function isExternal(): bool
    {
        return $this->baseMedia->external;
    }

    public function contexts(): ?ContextCollection
    {
        return $this->baseMedia->contexts;
    }

    public function type(): ?MediaType
    {
        return $this->baseMedia->type;
    }

    public function endpoint(): ?string
    {
        return $this->baseMedia->endpoint;
    }

    public function fileFormat(): ?string
    {
        return $this->baseMedia->fileFormat;
    }

    public function originalUri(): ?string
    {
        return $this->baseMedia->originalUri;
    }
}
