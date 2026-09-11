<?php

declare(strict_types=1);

namespace WebDevelovers\ResourceModels\Tests\Invariant;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Uid\UuidV7;
use WebDevelovers\ResourceModels\Invariant\UUIDIdentifiableTrait;

final class UUIDIdentifiableTraitTest extends TestCase
{
    public function testInitializeIdGeneratesUuidV7(): void
    {
        $model = new UUIDIdentifiableTraitFixture();

        $model->initializeForTest();

        self::assertInstanceOf(Uuid::class, $model->id);
        self::assertInstanceOf(UuidV7::class, $model->id);
    }
}

final class UUIDIdentifiableTraitFixture
{
    use UUIDIdentifiableTrait;

    public function initializeForTest(): void
    {
        $this->initializeId();
    }
}
