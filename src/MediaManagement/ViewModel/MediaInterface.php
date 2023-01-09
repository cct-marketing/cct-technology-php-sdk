<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\ViewModel;

interface MediaInterface
{
    public function toArray(): array;

    public function id(): ?string;

    public function name(): ?string;

    public function description(): ?string;

    public function private(): bool;

    public function extension(): ?string;

    public function status(): ?Status;

    public function external(): ?bool;

    public function isExternal(): bool;

    public function contexts(): ?ContextCollection;

    public function type(): ?MediaType;

    public function endpoint(): ?string;

    public function fileFormat(): ?string;

    public function originalUri(): ?string;
}
