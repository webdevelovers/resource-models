<?php

declare(strict_types=1);

namespace WebDevelovers\ResourceModels\Invariant;

use DateTimeInterface;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use WebDevelovers\ResourceModels\DateTimeUtils;

trait TimestampableTrait
{
    protected function initializeTimestamps(): void
    {
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: false)]
    protected(set) DateTimeInterface $createdAt {
        get => DateTimeUtils::localizeDateTime($this->createdAt);
    }

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: false)]
    protected(set) DateTimeInterface $updatedAt {
        get => DateTimeUtils::localizeDateTime($this->updatedAt);
    }

    public function refreshUpdatedAtTimestamp(): void
    {
        $this->updatedAt = new DateTime();
    }
}
