<?php

declare(strict_types=1);

namespace WebDevelovers\ResourceModels\Invariant;

use DateTimeInterface;

interface TimestampableInterface
{
    public DateTimeInterface $createdAt { get; }
    public DateTimeInterface $updatedAt { get; }

    public function refreshUpdatedAtTimestamp(): void;
}
