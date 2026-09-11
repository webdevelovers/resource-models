<?php

declare(strict_types=1);

namespace WebDevelovers\ResourceModels\Nullable;

interface AutoIncrementIdInterface
{
    public int|null $id { get; }
}

