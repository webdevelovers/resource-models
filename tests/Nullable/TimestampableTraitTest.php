<?php

declare(strict_types=1);

namespace WebDevelovers\ResourceModels\Tests\Nullable;

use DateTimeInterface;
use PHPUnit\Framework\TestCase;
use WebDevelovers\ResourceModels\DateTimeUtils;
use WebDevelovers\ResourceModels\Nullable\TimestampableTrait;

final class TimestampableTraitTest extends TestCase
{
    public function testTimestampsAreInitiallyNull(): void
    {
        $model = new TimestampableTraitFixture();

        self::assertNull($model->createdAt);
        self::assertNull($model->updatedAt);
    }

    public function testPrePersistSetsBothTimestamps(): void
    {
        $model = new TimestampableTraitFixture();

        $model->updateTimestampsOnCreate();

        self::assertInstanceOf(DateTimeInterface::class, $model->createdAt);
        self::assertInstanceOf(DateTimeInterface::class, $model->updatedAt);
        self::assertSame(DateTimeUtils::DEFAULT_TIMEZONE, $model->createdAt->getTimezone()->getName());
        self::assertSame(DateTimeUtils::DEFAULT_TIMEZONE, $model->updatedAt->getTimezone()->getName());
    }

    public function testPrePersistKeepsCreatedAtButRefreshesUpdatedAt(): void
    {
        $model = new TimestampableTraitFixture();
        $model->updateTimestampsOnCreate();
        $createdAt = $model->createdAt;
        $updatedAt = $model->updatedAt;

        usleep(1000000);
        $model->updateTimestampsOnCreate();

        self::assertSame($createdAt?->getTimestamp(), $model->createdAt?->getTimestamp());
        self::assertGreaterThan($updatedAt?->getTimestamp(), $model->updatedAt?->getTimestamp());
    }

    public function testPreUpdateRefreshesOnlyUpdatedAt(): void
    {
        $model = new TimestampableTraitFixture();
        $model->updateTimestampsOnCreate();
        $createdAt = $model->createdAt;
        $updatedAt = $model->updatedAt;

        usleep(1000000);
        $model->updateUpdatedAtTimestamp();

        self::assertSame($createdAt?->getTimestamp(), $model->createdAt?->getTimestamp());
        self::assertGreaterThan($updatedAt?->getTimestamp(), $model->updatedAt?->getTimestamp());
    }
}

final class TimestampableTraitFixture
{
    use TimestampableTrait;
}

