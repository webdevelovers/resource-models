<?php

declare(strict_types=1);

namespace WebDevelovers\ResourceModels\Invariant;

/**
 * Marker interface for the actor who enables/disables a resource.
 *
 * In real projects this is usually implemented by your user entity
 * (for example `App\Entity\User`).
 *
 * When this interface is used in Doctrine relations (see `ToggleableTrait`),
 * the consumer project should map it to a concrete entity through
 * Doctrine `resolve_target_entities`.
 */
interface ToggleActorInterface
{
}
