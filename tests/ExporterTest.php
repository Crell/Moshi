<?php

declare(strict_types=1);

namespace Crell\Moshi;

use Crell\Moshi\Schema\Schema;
use PHPUnit\Framework\TestCase;


class ExporterTest extends TestCase
{
    use TestUtils;

    protected function getSchema(string $file): Schema
    {
        $m = new SchemaParser();
        return $m->parse($this->loadFile($file));
    }

    protected function evalFileString(string $file): void
    {
        try {
            // Open a temporary file.
            $filename = tempnam(sys_get_temp_dir(), 'compiled');
            $out = fopen($filename, 'wb');

            // Write the string out to that file.
            fwrite($out, $file);

            // Close the file so it's flushed to disk.
            fclose($out);

            // Now include it.  If there's a parse error PHP will
            // throw a ParseError and PHPUnit will catch it for us.
            include($filename);
        }
        finally {
            // Clean up the file, even if a ParseError is
            // thrown above.
            // The OS may be lazy about cleaning up after us, so
            //  it's polite to do so.
            unlink($filename);
        }
    }

    /**
     * @test
     */
    public function stuff(): void
    {
        $namespace = 'My\\Name\\Space';

        $schema = $this->getSchema('schemas/getting-started/product.json');

        $ex = new Exporter([
            'https://example.com/product.schema.json' => 'Product',
        ]);

        $result = $ex->export($schema, $namespace);

        foreach ($result as $file) {
            $source = $file->generate();
            $this->evalFileString($source);
        }

        self::assertTrue(class_exists($namespace . '\\Product'));
        $classname = $namespace . '\\Product';
        $p = new $classname();

    }
}
