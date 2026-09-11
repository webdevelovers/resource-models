<?php

declare(strict_types=1);

namespace WebDevelovers\ResourceModels\Tests\Invariant;

use DomainException;
use PHPUnit\Framework\TestCase;
use WebDevelovers\ResourceModels\Invariant\SluggableTrait;

final class SluggableTraitTest extends TestCase
{
    public function testUpdateSlugStoresSlugifiedValue(): void
    {
        $model = new SluggableTraitFixture();

        $model->updateSlug('Hello World');

        self::assertSame('hello-world', $model->slug);
    }

    public function testUpdateSlugRejectsEmptyValue(): void
    {
        $model = new SluggableTraitFixture();

        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('The value that has to be slugged cannot be empty');

        $model->updateSlug('');
    }

    public function testSlugifySupportsCustomSeparatorAndCase(): void
    {
        $slug = SluggableTraitFixture::slugify('Hello World', '_', false);

        self::assertSame('Hello_World', $slug);
    }
}

final class SluggableTraitFixture
{
    use SluggableTrait;
}
