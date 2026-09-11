<?php

declare(strict_types=1);

namespace WebDevelovers\ResourceModels\Tests\Invariant;

use DateTime;
use DateTimeInterface;
use PHPUnit\Framework\TestCase;
use WebDevelovers\ResourceModels\DateTimeUtils;
use WebDevelovers\ResourceModels\Invariant\TimestampableTrait;

final class TimestampableTraitTest extends TestCase
{
    public function testInitializeSetsCreatedAtAndUpdatedAt(): void
    {
        $model = new TimestampableTraitFixture();

        $model->initializeForTest();

        self::assertInstanceOf(DateTimeInterface::class, $model->createdAt);
        self::assertInstanceOf(DateTimeInterface::class, $model->updatedAt);
        self::assertSame(DateTimeUtils::DEFAULT_TIMEZONE, $model->createdAt->getTimezone()->getName());
        self::assertSame(DateTimeUtils::DEFAULT_TIMEZONE, $model->updatedAt->getTimezone()->getName());
    }

    public function testRefreshUpdatedAtTimestampUpdatesTheValue(): void
    {
        $model = new TimestampableTraitFixture();
        $model->initializeForTest();
        $old = new DateTime('2000-01-01 00:00:00');
        $model->setUpdatedAtForTest($old);

        $model->refreshUpdatedAtTimestamp();

        self::assertGreaterThan($old->getTimestamp(), $model->updatedAt->getTimestamp());
        self::assertSame(DateTimeUtils::DEFAULT_TIMEZONE, $model->updatedAt->getTimezone()->getName());
    }
}

final class TimestampableTraitFixture
{
    use TimestampableTrait;

    public function initializeForTest(): void
    {
        $this->initializeTimestamps();
    }

    public function setUpdatedAtForTest(DateTimeInterface $value): void
    {
        $this->updatedAt = $value;
    }
}
