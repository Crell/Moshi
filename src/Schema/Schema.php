<?php

declare(strict_types=1);

namespace Crell\Moshi\Schema;

use Crell\Serde\DictionaryField;
use Crell\Serde\Field;
use Crell\Serde\Renaming\Prefix;
use Crell\Serde\SequenceField;

class Schema implements Property
{
    public function __construct(
        #[Field(renameWith: new Prefix('$'))]
        public readonly ?string $schema = null,
        #[Field(renameWith: new Prefix('$'))]
        public readonly ?string $id = null,
        public readonly ?string $title = null,
        public readonly ?string $description = null,
        #[DictionaryField(arrayType: Property::class)]
        public readonly array $properties = [],
        #[SequenceField]
        public readonly array $required = [],
    ) {}
}
