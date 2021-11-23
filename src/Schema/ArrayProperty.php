<?php

declare(strict_types=1);

namespace Crell\Moshi\Schema;


class ArrayProperty implements Property
{
    public function __construct(
        public readonly ?string $description = null,
        public readonly ?int $minItems = null,
        public readonly ?ItemDef $items = null,
        // Possibly default this to false, not null?
        public readonly ?bool $uniqueItems = null,
    ) {}
}