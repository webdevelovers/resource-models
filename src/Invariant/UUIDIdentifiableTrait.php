<?php

declare(strict_types=1);

namespace WebDevelovers\ResourceModels\Invariant;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

trait UUIDIdentifiableTrait
{
    protected function initializeId(): void
    {
        $this->id = Uuid::v7();
    }

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    #[ORM\Column(type: 'uuid', unique: true, nullable: false)]
    protected(set) Uuid $id;
}
