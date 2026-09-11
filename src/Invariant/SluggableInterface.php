<?php

declare(strict_types=1);

namespace WebDevelovers\ResourceModels\Invariant;

interface SluggableInterface
{
    public function updateSlug(string $value): void;

    public string $slug { get; }
}
