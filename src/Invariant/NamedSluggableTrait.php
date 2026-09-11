<?php

declare(strict_types=1);

namespace WebDevelovers\ResourceModels\Invariant;

/**
 * Combines naming and slugging behavior.
 *
 * Every time `name` changes through `NamedTrait`, slug is regenerated
 * through `SluggableTrait::updateSlug()`.
 */
trait NamedSluggableTrait
{
    use NamedTrait;
    use SluggableTrait;

    protected function afterNameChanged(string $value): void
    {
        $this->updateSlug($value);
    }
}
