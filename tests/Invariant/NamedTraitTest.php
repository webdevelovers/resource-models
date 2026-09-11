<?php

declare(strict_types=1);

namespace WebDevelovers\ResourceModels\Tests\Invariant;

use DomainException;
use PHPUnit\Framework\TestCase;
use WebDevelovers\ResourceModels\Invariant\NamedTrait;

final class NamedTraitTest extends TestCase
{
    public function testItSetsAndReturnsName(): void
    {
        $model = new NamedTraitFixture();

        $model->name = 'Product Name';

        self::assertSame('Product Name', $model->name);
        self::assertSame('Product Name', (string) $model);
        self::assertSame('Product Name', $model->lastChangedName);
    }

    public function testItRejectsEmptyName(): void
    {
        $model = new NamedTraitFixture();

        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Name cannot be empty');

        $model->name = '   ';
    }

    public function testItRejectsNullName(): void
    {
        $model = new NamedTraitFixture();

        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Name cannot be empty');

        $model->name = null;
    }
}

final class NamedTraitFixture
{
    use NamedTrait;

    public string|null $lastChangedName = null;

    protected function afterNameChanged(string $value): void
    {
        $this->lastChangedName = $value;
    }
}
