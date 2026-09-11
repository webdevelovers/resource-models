<?php

declare(strict_types=1);

namespace WebDevelovers\ResourceModels\Nullable;

use DateTime;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use WebDevelovers\ResourceModels\DateTimeUtils;

trait TimestampableTrait
{
    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    protected(set) DateTimeInterface|null $createdAt = null {
        get => $this->createdAt === null ? null : DateTimeUtils::localizeDateTime($this->createdAt);
    }

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    protected(set) DateTimeInterface|null $updatedAt = null {
        get => $this->updatedAt === null ? null : DateTimeUtils::localizeDateTime($this->updatedAt);
    }

    #[ORM\PrePersist]
    public function updateTimestampsOnCreate(): void
    {
        $now = new DateTime();
        $this->createdAt ??= $now;
        $this->updatedAt = $now;
    }

    #[ORM\PreUpdate]
    public function updateUpdatedAtTimestamp(): void
    {
        $this->updatedAt = new DateTime();
    }
}

