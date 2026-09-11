<?php

declare(strict_types=1);

namespace WebDevelovers\ResourceModels\Tests\Invariant;

use DateTimeInterface;
use PHPUnit\Framework\TestCase;
use WebDevelovers\ResourceModels\Invariant\ToggleActorInterface;
use WebDevelovers\ResourceModels\Invariant\ToggleableTrait;

final class ToggleableTraitTest extends TestCase
{
    public function testDisableSetsMetadataAndCallsHook(): void
    {
        $model = new ToggleableTraitFixture();
        $actor = new ToggleActorFixture();

        $model->disable($actor);

        self::assertFalse($model->enabled);
        self::assertInstanceOf(DateTimeInterface::class, $model->disabledAt);
        self::assertSame($actor, $model->disabledBy);
        self::assertSame(1, $model->afterDisabledCalls);
        self::assertSame($actor, $model->lastDisabledByInHook);
    }

    public function testDisableIsIdempotentWhenAlreadyDisabled(): void
    {
        $model = new ToggleableTraitFixture();
        $firstActor = new ToggleActorFixture();
        $secondActor = new ToggleActorFixture();

        $model->disable($firstActor);
        $disabledAt = $model->disabledAt;
        $model->disable($secondActor);

        self::assertFalse($model->enabled);
        self::assertSame($disabledAt, $model->disabledAt);
        self::assertSame($firstActor, $model->disabledBy);
        self::assertSame(1, $model->afterDisabledCalls);
    }

    public function testEnableClearsMetadataAndCallsHook(): void
    {
        $model = new ToggleableTraitFixture();
        $actor = new ToggleActorFixture();
        $model->disable($actor);

        $model->enable();

        self::assertTrue($model->enabled);
        self::assertNull($model->disabledAt);
        self::assertNull($model->disabledBy);
        self::assertSame(1, $model->afterEnabledCalls);
    }

    public function testEnableIsIdempotentWhenAlreadyEnabled(): void
    {
        $model = new ToggleableTraitFixture();

        $model->enable();

        self::assertTrue($model->enabled);
        self::assertNull($model->disabledAt);
        self::assertNull($model->disabledBy);
        self::assertSame(0, $model->afterEnabledCalls);
    }
}

final class ToggleableTraitFixture
{
    use ToggleableTrait;

    public int $afterEnabledCalls = 0;
    public int $afterDisabledCalls = 0;
    public ToggleActorInterface|null $lastDisabledByInHook = null;

    protected function afterEnabled(): void
    {
        ++$this->afterEnabledCalls;
    }

    protected function afterDisabled(ToggleActorInterface $disabledBy): void
    {
        ++$this->afterDisabledCalls;
        $this->lastDisabledByInHook = $disabledBy;
    }
}

final class ToggleActorFixture implements ToggleActorInterface
{
}
