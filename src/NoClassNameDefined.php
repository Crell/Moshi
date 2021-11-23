<?php

declare(strict_types=1);

namespace Crell\Moshi;

class NoClassNameDefined extends \InvalidArgumentException
{
    public readonly string $id;

    public static function create(string $id): static
    {
        $new = new static();
        $new->id = $id;

        $new->message = sprintf('No class name defined for schema object with ID %s', $id);
        return $new;
    }
}