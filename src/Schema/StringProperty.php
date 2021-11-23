<?php

declare(strict_types=1);

namespace Crell\Moshi\Schema;

class StringProperty implements Property
{
    public function __construct(
        public readonly ?string $description = null,
    ) {}
}