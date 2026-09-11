<?php

declare(strict_types=1);

namespace WebDevelovers\ResourceModels\Invariant;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use DomainException;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Throwable;

use function trim;

trait SluggableTrait
{
    /** @throws DomainException */
    public function updateSlug(string $value): void
    {
        if (empty($value) || trim($value) === '') {
            throw new DomainException('The value that has to be slugged cannot be empty');
        }

        $this->slug = self::slugify($value);
    }

    #[ORM\Column(type: Types::STRING, nullable: false)]
    private(set) string $slug;

    /** @throws DomainException */
    public static function slugify(
        string $value,
        string $separator = '-',
        bool $toLowerCase = true,
    ): string {
        try {
            $slugger = new AsciiSlugger();
            $slug = $slugger->slug($value, $separator);

            return $toLowerCase ? $slug->lower()->toString() : $slug->toString();
        } catch (Throwable $e) {
            throw new DomainException('Error during slug generation: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }
}
