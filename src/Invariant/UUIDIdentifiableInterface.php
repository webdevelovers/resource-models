<?php

declare(strict_types=1);

namespace WebDevelovers\ResourceModels\Invariant;

use Symfony\Component\Uid\Uuid;

interface UUIDIdentifiableInterface
{
    public Uuid $id { get; }
}
