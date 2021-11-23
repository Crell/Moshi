<?php

declare(strict_types=1);

namespace Crell\Moshi\Schema;

use Crell\Serde\StaticTypeMap;

#[StaticTypeMap('type', [
    'integer' => IntegerProperty::class,
    'string' => StringProperty::class,
    'number' => NumberProperty::class,
    'array' => ArrayProperty::class,
    'object' => Schema::class,
])]
interface Property
{

}
