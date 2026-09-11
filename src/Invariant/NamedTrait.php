<?php

declare(strict_types=1);

namespace WebDevelovers\ResourceModels\Invariant;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use DomainException;

trait NamedTrait
{
    #[ORM\Column(type: Types::STRING, nullable: false)]
    public string $name {
        /** @throws DomainException */
        set(string|null $value) {
            if (trim((string) $value) === '') {
                throw new DomainException('Name cannot be empty');
            }

            $this->name = $value;
            $this->afterNameChanged($value);
        }
        get => $this->name;
    }

    protected function afterNameChanged(string $value): void
    {
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
