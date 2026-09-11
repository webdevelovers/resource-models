<?php

declare(strict_types=1);

namespace WebDevelovers\ResourceModels\Tests\Nullable;

use PHPUnit\Framework\TestCase;
use WebDevelovers\ResourceModels\Nullable\AutoIncrementIdTrait;

final class AutoIncrementIdTraitTest extends TestCase
{
    public function testIdIsNullBeforePersistence(): void
    {
        $model = new AutoIncrementIdTraitFixture();

        self::assertNull($model->id);
    }
}

final class AutoIncrementIdTraitFixture
{
    use AutoIncrementIdTrait;
}

