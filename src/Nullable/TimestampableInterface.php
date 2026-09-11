<?php

declare(strict_types=1);

namespace WebDevelovers\ResourceModels\Nullable;

use DateTimeInterface;

interface TimestampableInterface
{
    public DateTimeInterface|null $createdAt { get; }
    public DateTimeInterface|null $updatedAt { get; }
}

