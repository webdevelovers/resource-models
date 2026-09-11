<?php

declare(strict_types=1);

namespace WebDevelovers\ResourceModels\Nullable;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait AutoIncrementIdTrait
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    protected(set) int|null $id = null;
}

