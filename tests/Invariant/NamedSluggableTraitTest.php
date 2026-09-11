<?php

declare(strict_types=1);

namespace WebDevelovers\ResourceModels\Tests\Invariant;

use PHPUnit\Framework\TestCase;
use WebDevelovers\ResourceModels\Invariant\NamedSluggableTrait;

final class NamedSluggableTraitTest extends TestCase
{
    public function testSettingNameGeneratesSlug(): void
    {
        $model = new NamedSluggableTraitFixture();

        $model->name = 'My Product Name';

        self::assertSame('my-product-name', $model->slug);
    }

    public function testChangingNameRegeneratesSlug(): void
    {
        $model = new NamedSluggableTraitFixture();

        $model->name = 'First Name';
        $model->name = 'Second Name';

        self::assertSame('second-name', $model->slug);
    }
}

final class NamedSluggableTraitFixture
{
    use NamedSluggableTrait;
}
