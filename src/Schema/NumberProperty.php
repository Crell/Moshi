<?php

declare(strict_types=1);

namespace Crell\Moshi\Schema;

class NumberProperty implements Property
{
    public function __construct(
        public readonly ?string $description = null,
        public readonly ?int $exclusiveMinimum = null,
        public readonly ?int $minimum = null,
        public readonly ?int $maximum = null,
    ) {}
}