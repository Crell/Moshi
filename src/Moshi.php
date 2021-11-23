<?php

declare(strict_types=1);

namespace Crell\Moshi;

use Crell\Moshi\Schema\Schema;
use Crell\Serde\Serde;
use Crell\Serde\SerdeCommon;

class Moshi
{
    public function __construct(
        protected Serde $serde = new SerdeCommon(),
    ) {}

    public function parse(string $schema): mixed
    {
        return $this->serde->deserialize($schema, from: 'json', to: Schema::class);
    }

}
