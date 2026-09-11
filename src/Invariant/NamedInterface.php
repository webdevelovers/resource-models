<?php

declare(strict_types=1);

namespace WebDevelovers\ResourceModels\Invariant;

interface NamedInterface
{
    public string $name {
        get;
        set;
    }

    public function __toString(): string;
}
