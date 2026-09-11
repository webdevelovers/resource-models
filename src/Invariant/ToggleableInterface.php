<?php

declare(strict_types=1);

namespace WebDevelovers\ResourceModels\Invariant;

use DateTimeInterface;

interface ToggleableInterface
{
    public bool $enabled { get; }
    public DateTimeInterface|null $disabledAt { get; }
    public ToggleActorInterface|null $disabledBy { get; }

    public function enable(): void;

    public function disable(ToggleActorInterface $disabledBy): void;
}
