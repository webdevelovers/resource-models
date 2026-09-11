<?php

declare(strict_types=1);

namespace WebDevelovers\ResourceModels\Invariant;

use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Reusable toggle behavior with actor and timestamp tracking.
 *
 * The `$disabledBy` association intentionally targets `ToggleActorInterface`
 * to keep this library decoupled from specific user implementations.
 *
 * In a real project, map `ToggleActorInterface` to your concrete actor entity
 * (for example `App\Entity\User`) via Doctrine `resolve_target_entities`.
 * Otherwise Doctrine cannot persist the interface-based relation.
 */
trait ToggleableTrait
{
    #[ORM\Column(type: Types::BOOLEAN, nullable: false, options: ['default' => true])]
    protected(set) bool $enabled = true;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    protected(set) DateTimeInterface|null $disabledAt = null;

    #[ORM\ManyToOne(targetEntity: ToggleActorInterface::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    protected(set) ToggleActorInterface|null $disabledBy = null;

    public function enable(): void
    {
        if ($this->enabled) {
            return;
        }

        $this->enabled = true;
        $this->disabledAt = null;
        $this->disabledBy = null;
        $this->afterEnabled();
    }

    public function disable(ToggleActorInterface $disabledBy): void
    {
        if (! $this->enabled) {
            return;
        }

        $this->enabled = false;
        $this->disabledAt = new DateTime();
        $this->disabledBy = $disabledBy;
        $this->afterDisabled($disabledBy);
    }

    protected function afterEnabled(): void
    {
    }

    protected function afterDisabled(ToggleActorInterface $disabledBy): void
    {
    }
}
