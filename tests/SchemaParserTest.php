<?php

declare(strict_types=1);

namespace Crell\Moshi;

use Crell\Moshi\Schema\ArrayProperty;
use Crell\Moshi\Schema\IntegerProperty;
use Crell\Moshi\Schema\NumberProperty;
use Crell\Moshi\Schema\Schema;
use Crell\Moshi\Schema\StringProperty;
use PHPUnit\Framework\TestCase;

class SchemaParserTest extends TestCase
{
    use TestUtils;

    /**
     * @test
     */
    public function stuff(): void
    {
        $m = new SchemaParser();

        $schema = $m->parse($this->loadFile('schemas/getting-started/product.json'));

        self::assertEquals('https://example.com/product.schema.json', $schema->id);
        self::assertCount(5, $schema->properties);

        self::assertInstanceOf(IntegerProperty::class, $schema->properties['productId']);
        self::assertInstanceOf(StringProperty::class, $schema->properties['productName']);
        self::assertInstanceOf(NumberProperty::class, $schema->properties['price']);
        self::assertInstanceOf(ArrayProperty::class, $schema->properties['tags']);
        self::assertInstanceOf(Schema::class, $schema->properties['dimensions']);
        self::assertInstanceOf(Schema::class, $schema->properties['dimensions']);

        self::assertCount(3, $schema->required);

        self::assertTrue(true);
    }
}
