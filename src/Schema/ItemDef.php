<?php

declare(strict_types=1);

namespace Crell\Moshi\Schema;

class ItemDef
{
    public function __construct(
        public readonly Type $type,
    ) {}
}